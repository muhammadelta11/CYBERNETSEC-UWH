<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Import Data Mahasiswa'
        ];
        return view('admin.import.index', $data);
    }

    public function showImportForm()
    {
        $data = [
            'title' => 'Import Data Mahasiswa dari Excel/CSV'
        ];
        return view('admin.import.form', $data);
    }

    public function importMahasiswa(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt,xlsx,xls|max:2048',
        ]);

        try {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            
            if ($extension === 'csv') {
                return $this->importFromCSV($file);
            } else {
                return $this->importFromExcel($file);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function importFromCSV($file)
    {
        $csvData = array_map('str_getcsv', file($file->getRealPath()));
        $header = array_shift($csvData); // Remove header row
        
        // Validate header
        $expectedHeaders = ['nama', 'nim', 'email', 'whatsapp'];
        if (!$this->validateHeaders($header, $expectedHeaders)) {
            return redirect()->back()->with('error', 'Format header CSV tidak sesuai. Header yang dibutuhkan: nama, nim, email, whatsapp');
        }

        return $this->processImportData($csvData, $header);
    }

    private function importFromExcel($file)
    {
        // For Excel files, we'll use a simple approach
        // In production, you might want to use Laravel Excel package
        return redirect()->back()->with('error', 'Import Excel belum didukung. Silakan gunakan format CSV.');
    }

    private function validateHeaders($actualHeaders, $expectedHeaders)
    {
        $actualHeaders = array_map('strtolower', array_map('trim', $actualHeaders));
        $expectedHeaders = array_map('strtolower', $expectedHeaders);
        
        foreach ($expectedHeaders as $expected) {
            if (!in_array($expected, $actualHeaders)) {
                return false;
            }
        }
        return true;
    }

    private function processImportData($data, $header)
    {
        $successCount = 0;
        $errorCount = 0;
        $errors = [];
        $duplicates = [];

        // Normalize header keys
        $header = array_map('strtolower', array_map('trim', $header));
        
        DB::beginTransaction();
        
        try {
            foreach ($data as $rowIndex => $row) {
                $rowNumber = $rowIndex + 2; // +2 because we removed header and array is 0-indexed
                
                if (empty(array_filter($row))) {
                    continue; // Skip empty rows
                }

                // Map row data to associative array
                $rowData = array_combine($header, $row);
                
                // Validate row data
                $validator = Validator::make($rowData, [
                    'nama' => 'required|string|max:255',
                    'nim' => 'required|string|max:255',
                    'email' => 'nullable|email|max:255',
                    'whatsapp' => 'nullable|string|max:20',
                ]);

                if ($validator->fails()) {
                    $errorCount++;
                    $errors[] = "Baris {$rowNumber}: " . implode(', ', $validator->errors()->all());
                    continue;
                }

                // Check for duplicates
                $query = User::where('nim', trim($rowData['nim']));
                if (!empty(trim($rowData['email']))) {
                    $query->orWhere('email', trim($rowData['email']));
                }
                $existingUser = $query->first();

                if ($existingUser) {
                    $duplicates[] = "Baris {$rowNumber}: NIM {$rowData['nim']} atau Email {$rowData['email']} sudah ada";
                    continue;
                }

                // Create user
                User::create([
                    'name' => trim($rowData['nama']),
                    'nim' => trim($rowData['nim']),
                    'email' => trim($rowData['email']),
                    'whatsapp' => !empty($rowData['whatsapp']) ? trim($rowData['whatsapp']) : null,
                    'password' => Hash::make(trim($rowData['nim'])), // Default password = NIM
                    'role' => User::ROLE_REGULAR,
                    'status' => User::STATUS_ACTIVE, // Mahasiswa langsung aktif
                    'user_type' => User::USER_TYPE_MAHASISWA
                ]);

                $successCount++;
            }

            DB::commit();

            $message = "Import selesai! {$successCount} data berhasil diimport.";
            
            if ($errorCount > 0) {
                $message .= " {$errorCount} data gagal diimport.";
            }
            
            if (!empty($duplicates)) {
                $message .= " " . count($duplicates) . " data duplikat dilewati.";
            }

            $result = [
                'success' => $successCount,
                'errors' => $errorCount,
                'duplicates' => count($duplicates),
                'error_details' => $errors,
                'duplicate_details' => $duplicates
            ];

            return redirect()->back()->with('success', $message)->with('import_result', $result);

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat import: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="template_import_mahasiswa.csv"',
        ];

        $callback = function() {
            $file = fopen('php://output', 'w');
            
            // Header CSV
            fputcsv($file, ['nama', 'nim', 'email', 'whatsapp']);
            
            // Sample data
            fputcsv($file, ['John Doe', '2021001', 'john.doe@example.com', '081234567890']);
            fputcsv($file, ['Jane Smith', '2021002', 'jane.smith@example.com', '081234567891']);
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function bulkDelete(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        try {
            $deletedCount = User::whereIn('id', $request->user_ids)
                               ->where('user_type', User::USER_TYPE_MAHASISWA)
                               ->delete();

            return redirect()->back()->with('success', "{$deletedCount} data mahasiswa berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
