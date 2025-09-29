<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KursusController extends Controller
{
    public function diambil()
    {
        $kelas = Auth::user()->kelas()->with('upskillCategory')->paginate(9);
        return view('front.kursus.diambil', compact('kelas'));
    }

    public function daftar()
    {
        $enrolledKelasIds = Auth::user()->kelas->pluck('id');
        $kelas = Kelas::whereNotIn('id', $enrolledKelasIds)->get();
        return view('front.kursus.daftar', compact('kelas'));
    }

    public function enroll(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        $user = Auth::user();

        // Check if user already enrolled
        if ($user->kelas->contains($kelas)) {
            return redirect()->route('kursus.daftar')->with('error', 'Anda sudah terdaftar di kursus ini.');
        }

        // Differentiate payment logic based on kelas type
        if ($kelas->type_kelas == 3) {
            // Program Upskill: check if payment transaction exists and approved
            $transaksi = \App\Transaksi::where('users_id', $user->id)
                ->where('kelas_id', $kelas->id)
                ->where('status', 1)
                ->first();

            if (!$transaksi) {
                // Redirect to payment page for kelas
                return redirect()->route('transaksi.kelas', $kelas->id)
                    ->with('error', 'Anda harus melakukan pembayaran untuk kelas ini terlebih dahulu.');
            }
        } elseif ($kelas->type_kelas == 2) {
            // Premium: check if user role is premium
            if ($user->role != 'premium') {
                return redirect()->route('upgradepremium')->with('error', 'Anda harus upgrade ke premium untuk mengakses kelas ini.');
            }
        }

        // Enroll user to kelas
        $user->kelas()->attach($kelas);
        return redirect()->route('kursus.diambil')->with('success', 'Berhasil mendaftar kursus!');
    }
}
