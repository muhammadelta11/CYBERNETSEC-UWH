<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Kelas;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class KelasController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        $isMahasiswa = $user && $user->isMahasiswa();

        // For SkilLab: Show all classes except upskill classes (type_kelas != 3)
        $classes = Kelas::with('upskillCategory')->where('type_kelas', '!=', 3)->get();

        // Group classes by category
        $categories = collect();
        $uncategorizedClasses = collect();

        foreach ($classes as $class) {
            if ($class->upskillCategory) {
                $categoryId = $class->upskillCategory->id;
                if (!$categories->has($categoryId)) {
                    $categories->put($categoryId, $class->upskillCategory->replicate());
                    $categories[$categoryId]->kelas = collect();
                }
                $categories[$categoryId]->kelas->push($class);
            } else {
                $uncategorizedClasses->push($class);
            }
        }

        // Add uncategorized classes as a special category if any exist
        if ($uncategorizedClasses->count() > 0) {
            $otherCategory = new \App\UpskillCategory();
            $otherCategory->id = 'other';
            $otherCategory->name = 'Kelas Lainnya';
            $otherCategory->description = 'Kelas yang belum dikategorikan';
            $otherCategory->kelas = $uncategorizedClasses;
            $categories->put('other', $otherCategory);
        }

        $data = [
            'categories' => $categories,
            'isMahasiswa' => $isMahasiswa,
            'user' => $user,
            'viewMode' => 'skilLab'
        ];

        return view('front.kelas.index', $data);
    }

    public function upskill()
    {
        $user = auth()->user();

        // Only allow mahasiswa to access upskill
        if (!$user || !$user->isMahasiswa()) {
            return redirect()->route('kelas')->with('error', 'Akses terbatas untuk mahasiswa.');
        }

        // Show upskill classes with semester filtering based on NIM
        $semesters = \App\Semester::with(['upskillCategories.kelas'])->get();

        // Calculate accessible semesters based on NIM angkatan
        $accessibleSemesters = $this->getAccessibleSemesters($user);

        // Filter semesters that mahasiswa can access
        $filteredSemesters = $semesters->filter(function ($semester) use ($accessibleSemesters) {
            return in_array($semester->id, $accessibleSemesters);
        })->map(function ($semester) {
            // Only show upskill classes (type_kelas = 3)
            $semester->upskillCategories = $semester->upskillCategories->map(function ($category) {
                $category->kelas = $category->kelas->filter(function ($kelas) {
                    return $kelas->type_kelas == 3; // Only upskill classes
                });
                return $category;
            })->filter(function ($category) {
                return $category->kelas->count() > 0;
            });
            return $semester;
        })->filter(function ($semester) {
            return $semester->upskillCategories->count() > 0;
        });

        $data = [
            'semesters' => $filteredSemesters,
            'isMahasiswa' => true,
            'user' => $user,
            'viewMode' => 'upskill'
        ];

        return view('front.kelas.index', $data);
    }

    /**
     * Calculate accessible semesters based on mahasiswa's NIM angkatan
     */
    private function getAccessibleSemesters($user)
    {
        if (!$user || !$user->nim) {
            return []; // No access if no NIM
        }

        $angkatan = $user->angkatan; // e.g., "22" for 2022
        if (!$angkatan) {
            return [];
        }

        $currentYear = date('y'); // Current year in 2 digits, e.g., "25" for 2025
        $angkatanYear = intval($angkatan);

        // Calculate how many years have passed since angkatan
        $yearsPassed = intval($currentYear) - $angkatanYear;

        // Each academic year has 2 semesters
        $currentSemester = ($yearsPassed * 2) + 1; // +1 for current semester

        // Mahasiswa can access semesters 1 to current semester
        $accessibleSemesters = [];
        for ($i = 1; $i <= $currentSemester; $i++) {
            $accessibleSemesters[] = $i;
        }

        return $accessibleSemesters;
    }

    public function detail($id)
    {
        $dec_id = Crypt::decrypt($id);
        $data = [
            'kelas' => Kelas::find($dec_id)
        ];

        return view('front.kelas.detail',$data);
    }

    public function belajar($id,$idmateri)
    {
        $dec_id = Crypt::decrypt($id);
        $dec_idmateri = Crypt::decrypt($idmateri);

        $kelas = Kelas::find($dec_id);
        $materi = \App\Materi::find($dec_idmateri);

        // Get current user
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Anda harus login untuk mengakses halaman belajar.');
        }

        // Check if user is enrolled in the kelas via UserKelas
        $enrolled = \App\UserKelas::where('user_id', $user->id)
            ->where('kelas_id', $dec_id)
            ->exists();

        if (!$enrolled) {
            return redirect()->route('kelas.detail', $id)->with('error', 'Anda tidak memiliki akses ke kelas ini.');
        }

        // Get completed materi for this user and kelas
        $completedMateri = $user->materi()->whereHas('kelas', function($query) use ($dec_id) {
            $query->where('id', $dec_id);
        })->pluck('materi.id')->toArray();

        // Pass current index for progress calculation
        $currentIndex = $kelas->materi->search(function ($item) use ($dec_idmateri) {
            return $item->id == $dec_idmateri;
        });

        $data = [
            'kelas' => $kelas,
            'materi' => $materi,
            'completedMateri' => $completedMateri,
            'currentIndex' => $currentIndex,
        ];

        return view('front.kelas.belajar', $data);
    }

    public function markCompleted(Request $request)
    {
        $user = auth()->user();
        $materiId = $request->input('materi_id');

        if (!$materiId) {
            return response()->json(['error' => 'Materi ID is required'], 400);
        }

        $progress = \App\Progress::updateOrCreate(
            ['user_id' => $user->id, 'materi_id' => $materiId],
            ['completed_at' => now()]
        );

        return response()->json(['success' => true]);
    }

    public function downloadMateri($id)
    {
        try {
            $dec_id = Crypt::decrypt($id);
            $materi = \App\Materi::with('kelas')->findOrFail($dec_id);

            $user = auth()->user();
            if (!$user) {
                abort(401, 'Anda harus login untuk mengakses materi ini.');
            }

            // Check if user is enrolled in the kelas via UserKelas
            $enrolled = \App\UserKelas::where('user_id', $user->id)
                ->where('kelas_id', $materi->kelas_id)
                ->exists();

            if (!$enrolled) {
                abort(403, 'Anda tidak memiliki akses ke materi ini.');
            }

            $filePath = storage_path('app/' . $materi->url);
            if (!file_exists($filePath)) {
                abort(404, 'File tidak ditemukan.');
            }

            $filename = basename($materi->url);
            $mimeType = mime_content_type($filePath) ?: 'application/octet-stream';

            return response()->file($filePath, [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'inline; filename="' . $filename . '"',
            ]);
        } catch (\Exception $e) {
            abort(404, 'Materi tidak ditemukan.');
        }
    }
}
