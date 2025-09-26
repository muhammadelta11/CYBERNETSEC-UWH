<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Notifications\UserRejectedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserLogController extends Controller
{
    public function index(Request $request)
    {
        $query = User::whereNotIn('role', ['admin', 'admin_upskill', 'operator'])
                    ->whereIn('user_type', ['mahasiswa', 'umum'])
                    ->with(['kelas.upskillCategory']);

        // Filter by user_type if provided
        if ($request->has('user_type') && $request->user_type !== '') {
            $query->where('user_type', $request->user_type);
        }

        // Filter by status if provided
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        $data = [
            'title' => 'Riwayat Pendaftaran User',
            'users' => $users,
            'selected_user_type' => $request->user_type ?? '',
            'selected_status' => $request->status ?? ''
        ];
        return view('admin.userlog.index', $data);
    }



    public function export(Request $request)
    {
        $query = User::whereNotIn('role', ['admin', 'admin_upskill', 'operator'])
                    ->whereIn('user_type', ['mahasiswa', 'umum'])
                    ->with(['kelas.upskillCategory']);

        // Filter by user_type if provided
        if ($request->has('user_type') && $request->user_type !== '') {
            $query->where('user_type', $request->user_type);
        }

        // Filter by status if provided
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        $filename = 'riwayat_pendaftaran_user_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($users) {
            $file = fopen('php://output', 'w');

            // CSV headers
            fputcsv($file, ['NIM', 'Nama User', 'Semester', 'Tipe User', 'Status', 'Tanggal Registrasi', 'Kategori & Kelas yang Diambil']);

            foreach ($users as $user) {
                $categories = [];
                foreach($user->kelas as $kelas) {
                    $categoryName = $kelas->upskillCategory ? $kelas->upskillCategory->name : 'Tanpa Kategori';
                    if (!isset($categories[$categoryName])) {
                        $categories[$categoryName] = [];
                    }
                    $categories[$categoryName][] = $kelas->name_kelas;
                }

                $classesStr = '';
                if (count($categories) > 0) {
                    $parts = [];
                    foreach ($categories as $category => $classes) {
                        $parts[] = $category . ': ' . implode(', ', $classes);
                    }
                    $classesStr = implode('; ', $parts);
                } else {
                    $classesStr = 'Tidak ada kelas';
                }

                fputcsv($file, [
                    $user->nim ?: '-',
                    $user->name,
                    $user->semester ?: '-',
                    $user->user_type_display,
                    $user->status_display,
                    $user->created_at->format('Y-m-d H:i:s'),
                    $classesStr
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function detail($id)
    {
        $dec_id = \Crypt::decrypt($id);
        $data = [
            'title' => 'Detail Riwayat User',
            'user' => User::with('kelas')->find($dec_id)
        ];
        return view('admin.userlog.detail', $data);
    }

    public function edit($id)
    {
        $dec_id = \Crypt::decrypt($id);
        $data = [
            'title' => 'Edit Riwayat User',
            'user' => User::find($dec_id)
        ];
        return view('admin.userlog.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $dec_id = \Crypt::decrypt($id);
        $user = User::find($dec_id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $dec_id,
            'whatsapp' => 'nullable|string|max:20|regex:/^([0-9+\-\s]+)$/',
            'role' => 'required|in:regular,premium',
            'nim' => 'nullable|string|max:20'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'role' => $request->role,
            'nim' => $request->nim
        ]);

        return redirect()->route('admin.userlog.detail', $id)->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        $dec_id = \Crypt::decrypt($id);
        $user = User::find($dec_id);

        // Prevent deleting admin users
        if ($user->role === 'admin') {
            return redirect()->route('admin.userlog')->with('error', 'Tidak dapat menghapus akun admin');
        }

        // Delete related data first
        $user->kelas()->detach(); // Remove from user_kelas table
        $user->delete();

        return redirect()->route('admin.userlog')->with('success', 'User berhasil dihapus');
    }

    public function approve($id)
    {
        $dec_id = \Crypt::decrypt($id);
        $user = User::find($dec_id);

        if (!$user) {
            return redirect()->route('admin.userlog')->with('error', 'User tidak ditemukan');
        }

        if ($user->status === 'active') {
            return redirect()->route('admin.userlog')->with('warning', 'User sudah aktif');
        }

        $user->update(['status' => 'active']);

        return redirect()->route('admin.userlog')->with('success', 'User berhasil disetujui');
    }

    public function reject($id)
    {
        try {
            $dec_id = \Crypt::decrypt($id);
            $user = User::find($dec_id);

            if (!$user) {
                Log::error('User not found for rejection', ['user_id' => $dec_id]);
                return redirect()->route('admin.userlog')->with('error', 'User tidak ditemukan');
            }

            if ($user->status === 'active') {
                return redirect()->route('admin.userlog')->with('warning', 'Tidak dapat menolak user yang sudah aktif');
            }

            // Log the rejection attempt
            Log::info('Attempting to reject user', [
                'user_id' => $user->id,
                'user_email' => $user->email,
                'current_status' => $user->status
            ]);

            // Set status to 'rejected' instead of 'inactive' to distinguish from pending users
            $user->update(['status' => 'rejected']);

            // Send rejection notification email
            try {
                $user->notify(new UserRejectedNotification());
                Log::info('Rejection notification sent successfully', ['user_id' => $user->id]);
            } catch (\Exception $e) {
                Log::error('Failed to send rejection notification', [
                    'user_id' => $user->id,
                    'error' => $e->getMessage()
                ]);
                // Don't fail the rejection if email fails, just log it
            }

            Log::info('User successfully rejected', [
                'user_id' => $user->id,
                'new_status' => $user->status
            ]);

            return redirect()->route('admin.userlog')->with('success', 'User berhasil ditolak dan notifikasi email telah dikirim');

        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Log::error('Failed to decrypt user ID for rejection', ['error' => $e->getMessage()]);
            return redirect()->route('admin.userlog')->with('error', 'ID User tidak valid');
        } catch (\Exception $e) {
            Log::error('Error rejecting user', [
                'user_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('admin.userlog')->with('error', 'Terjadi kesalahan saat menolak user. Silakan coba lagi.');
        }
    }

    public function deactivate($id)
    {
        $dec_id = \Crypt::decrypt($id);
        $user = User::find($dec_id);

        if (!$user) {
            return redirect()->route('admin.userlog')->with('error', 'User tidak ditemukan');
        }

        if ($user->status === 'inactive') {
            return redirect()->route('admin.userlog')->with('warning', 'User sudah tidak aktif');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.userlog')->with('error', 'Tidak dapat menonaktifkan akun admin');
        }

        $user->update(['status' => 'inactive']);

        return redirect()->route('admin.userlog')->with('success', 'User berhasil dinonaktifkan');
    }
}
