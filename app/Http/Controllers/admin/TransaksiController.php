<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Transaksi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class TransaksiController extends Controller
{
    public function index()
    {
        $query = Transaksi::with('users', 'kelas');

        if (auth()->user()->isAdminUpskill()) {
            $query->whereHas('kelas', function($q) {
                $q->where('type_kelas', '3');
            });
        }

        $data = [
            'title' => 'Semua Transaksi',
            'transaksis' => $query->get(),
        ];
        return view('admin.transaksi.index', $data);
    }

    public function belumdicek()
    {
        $query = Transaksi::with('users', 'kelas')->where(['status' => 0]);

        if (auth()->user()->isAdminUpskill()) {
            $query->whereHas('kelas', function($q) {
                $q->where('type_kelas', 'Upskill');
            });
        }

        $data = [
            'title' => 'Transaksi Belum Dicek ',
            'transaksis' => $query->get(),
        ];
        return view('admin.transaksi.index', $data);
    }

    public function disetujui()
    {
        $query = Transaksi::with('users', 'kelas')->where(['status' => 1]);

        if (auth()->user()->isAdminUpskill()) {
            $query->whereHas('kelas', function($q) {
                $q->where('type_kelas', 'Upskill');
            });
        }

        $data = [
            'title' => 'Transaksi Disetujui',
            'transaksis' => $query->get(),
        ];
        return view('admin.transaksi.index', $data);
    }

    public function ditolak()
    {
        $query = Transaksi::with('users', 'kelas')->where(['status' => 2]);

        if (auth()->user()->isAdminUpskill()) {
            $query->whereHas('kelas', function($q) {
                $q->where('type_kelas', 'Upskill');
            });
        }

        $data = [
            'title' => 'Transaksi Ditolak',
            'transaksis' => $query->get(),
        ];
        return view('admin.transaksi.index', $data);
    }

    public function detail($id)
    {
        $dec_id = Crypt::decrypt($id);
        $transaksi = Transaksi::with('users', 'kelas')->find($dec_id);
        if (!$transaksi) {
            abort(404, 'Transaksi tidak ditemukan');
        }

        if (auth()->user()->isAdminUpskill() && (!$transaksi->kelas || $transaksi->kelas->type_kelas != 'Upskill')) {
            abort(403, 'Unauthorized');
        }

        $data = [
            'title' => 'Detail Transaksi',
            'transaksi' => $transaksi
        ];
        return view('admin.transaksi.detail', $data);
    }

    public function ubah(Request $request,$id)
    {
        $dec_id = Crypt::decrypt($id);
        $transaksi = Transaksi::with('users', 'kelas')->find($dec_id);
        $old_status = $transaksi->status;
        $new_status = $request->status;

        $transaksi->status = $new_status;

        if($new_status == 1){
            // Approve
            if (!$transaksi->kelas_id) {
                User::where('id','=',$transaksi->users_id)->update(['role' => 'premium']);
            } else {
                \App\UserKelas::firstOrCreate([
                    'user_id' => $transaksi->users_id,
                    'kelas_id' => $transaksi->kelas_id,
                ]);
            }
        } elseif($new_status == 2){
            // Reject
            if (!$transaksi->kelas_id) {
                User::where('id','=',$transaksi->users_id)->update(['role' => 'regular']);
            } else {
                // If previously approved, unenroll
                if ($old_status == 1) {
                    \App\UserKelas::where('user_id', $transaksi->users_id)
                        ->where('kelas_id', $transaksi->kelas_id)
                        ->delete();
                }
            }
        }

        $transaksi->save();
        return redirect()->route('admin.transaksi')->with('status','Berhasil Memperbaharui Status');
    }
}

