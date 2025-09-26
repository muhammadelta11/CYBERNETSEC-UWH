<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $totalKursus = $user->kelas()->count();
        $totalSertifikat = $user->sertifikats()->count();
        $totalEventRegistrations = $user->eventRegistrations()->count();
        $pendingPayments = $user->eventRegistrations()->where('status', 'pending')->where('amount_paid', '>', 0)->count();

        return view('front.dashboard', compact('totalKursus', 'totalSertifikat', 'totalEventRegistrations', 'pendingPayments'));
    }
}
