<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Sertifikat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class SertifikatController extends Controller
{
    public function index()
    {
        $sertifikats = Sertifikat::where('user_id', Auth::id())->paginate(9);
        return view('front.sertifikat.index', compact('sertifikats'));
    }

    public function download($id)
    {
        $dec_id = Crypt::decrypt($id);
        $sertifikat = Sertifikat::where('id', $dec_id)->where('user_id', Auth::id())->firstOrFail();

        if (!$sertifikat->file_sertifikat) {
            abort(404, 'File sertifikat tidak ditemukan');
        }

        $filePath = storage_path('app/public/' . $sertifikat->file_sertifikat);

        if (!file_exists($filePath)) {
            abort(404, 'File sertifikat tidak ditemukan');
        }

        return response()->download($filePath, $sertifikat->nama_sertifikat . '.' . pathinfo($filePath, PATHINFO_EXTENSION));
    }
}
