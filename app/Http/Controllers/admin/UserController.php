<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Notifications\UserRejectedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::whereIn('role', ['regular', 'premium']);

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
            'title' => 'Kelola User',
            'users' => $users,
            'selected_user_type' => $request->user_type ?? '',
            'selected_status' => $request->status ?? ''
        ];
        return view('admin.user.index',$data);
    }

    public function export(Request $request)
    {
        $query = User::whereIn('role', ['regular', 'premium']);

        // Filter by user_type if provided
        if ($request->has('user_type') && $request->user_type !== '') {
            $query->where('user_type', $request->user_type);
        }

        // Filter by status if provided
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $users = $query->orderBy('created_at', 'desc')->get();

        $filename = 'data_user_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($users) {
            $file = fopen('php://output', 'w');

            // CSV headers
            fputcsv($file, ['Nama User', 'NIM', 'Email', 'Semester', 'Tipe User', 'Role', 'Status', 'WhatsApp', 'Tanggal Registrasi']);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->name,
                    $user->nim ?: '-',
                    $user->email,
                    $user->semester ?: '-',
                    $user->user_type_display,
                    $user->role_display,
                    $user->status_display,
                    $user->whatsapp ?: '-',
                    $user->created_at->format('d-m-Y H:i:s')
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
            'title' => 'Detail User',
            'user' => User::with('kelas')->find($dec_id)
        ];
        return view('admin.user.detail', $data);
    }

    public function edit($id)
    {
        $dec_id = \Crypt::decrypt($id);
        $data = [
            'title' => 'Edit User',
            'user' => User::find($dec_id)
        ];
        return view('admin.user.edit', $data);
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

        return redirect()->route('admin.user.detail', $id)->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
    {
        $dec_id = \Crypt::decrypt($id);
        $user = User::find($dec_id);

        // Prevent deleting admin users
        if ($user->role === 'admin') {
            return redirect()->route('admin.user')->with('error', 'Tidak dapat menghapus akun admin');
        }

        // Delete related data first
        $user->kelas()->detach(); // Remove from user_kelas table
        $user->delete();

        return redirect()->route('admin.user')->with('success', 'User berhasil dihapus');
    }

    public function approve($id)
    {
        $dec_id = \Crypt::decrypt($id);
        $user = User::find($dec_id);

        if (!$user) {
            return redirect()->route('admin.user')->with('error', 'User tidak ditemukan');
        }

        if ($user->status === 'active') {
            return redirect()->route('admin.user')->with('warning', 'User sudah aktif');
        }

        $user->update(['status' => 'active']);

        return redirect()->route('admin.user')->with('success', 'User berhasil disetujui');
    }

    public function reject($id)
    {
        try {
            $dec_id = \Crypt::decrypt($id);
            $user = User::find($dec_id);

            if (!$user) {
                Log::error('User not found for rejection', ['user_id' => $dec_id]);
                return redirect()->route('admin.user')->with('error', 'User tidak ditemukan');
            }

            if ($user->status === 'active') {
                return redirect()->route('admin.user')->with('warning', 'Tidak dapat menolak user yang sudah aktif');
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

            return redirect()->route('admin.user')->with('success', 'User berhasil ditolak dan notifikasi email telah dikirim');

        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            Log::error('Failed to decrypt user ID for rejection', ['error' => $e->getMessage()]);
            return redirect()->route('admin.user')->with('error', 'ID User tidak valid');
        } catch (\Exception $e) {
            Log::error('Error rejecting user', [
                'user_id' => $id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('admin.user')->with('error', 'Terjadi kesalahan saat menolak user. Silakan coba lagi.');
        }
    }

    public function deactivate($id)
    {
        $dec_id = \Crypt::decrypt($id);
        $user = User::find($dec_id);

        if (!$user) {
            return redirect()->route('admin.user')->with('error', 'User tidak ditemukan');
        }

        if ($user->status === 'inactive') {
            return redirect()->route('admin.user')->with('warning', 'User sudah tidak aktif');
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.user')->with('error', 'Tidak dapat menonaktifkan akun admin');
        }

        $user->update(['status' => 'inactive']);

        return redirect()->route('admin.user')->with('success', 'User berhasil dinonaktifkan');
    }

    public function editprofil()
    {
        $data = [
            'title' => 'Edit Profil',
        ];

        return view('admin.akun.editprofil',$data);
    }

    public function simpaneditprofil(Request $request)
    {
        if ($request->email == Auth::user()->email) {
            $validator = Validator::make($request->all(), [
                'name' => 'required:string',
                'email' => 'required'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required:string',
                'email' => 'required|unique:users|email'
            ]);
        }

        if ($validator->fails()) {
            return redirect()->route('akun.editprofil')->withErrors($validator)->withInput();
        } else {
            User::where('id', '=', Auth::user()->id)->update([
                'email' => $request->email,
                'name' => $request->name
            ]);
            return redirect()->route('admin.editprofil')->with('status', 'Berhasil memperbarui profil');
        }
    }

    public function editkatasandi()
    {
        $data = [
            'title' => 'Edit Katasandi',
        ];
        return view('admin.akun.editkatasandi',$data);
    }

    public function simpaneditkatasandi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('akun.editkatasandi')->withErrors($validator)->withInput();
        } else {
            User::where('id', '=', Auth::user()->id)->update([
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('admin')->with('status', 'Berhasil memperbarui katasandi');
        }
    }
}
