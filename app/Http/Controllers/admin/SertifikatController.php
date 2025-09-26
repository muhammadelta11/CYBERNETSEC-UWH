<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Sertifikat;
use App\User;
use Illuminate\Http\Request;

class SertifikatController extends Controller
{
    public function index()
    {
        $sertifikats = Sertifikat::with('user')->get();
        $title = 'E-Sertifikat';
        return view('admin.sertifikat.index', compact('sertifikats', 'title'));
    }

    public function create()
    {
        $users = User::all();
        $title = 'Tambah E-Sertifikat';
        return view('admin.sertifikat.create', compact('users', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_sertifikat' => 'required|string',
            'tanggal_diterbitkan' => 'required|date',
            'file_sertifikat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('file_sertifikat')) {
            $filePath = $request->file('file_sertifikat')->store('sertifikat', 'public');
        }

        Sertifikat::create([
            'user_id' => $request->user_id,
            'nama_sertifikat' => $request->nama_sertifikat,
            'tanggal_diterbitkan' => $request->tanggal_diterbitkan,
            'file_sertifikat' => $filePath,
        ]);

        return redirect()->route('admin.sertifikat')->with('success', 'Sertifikat berhasil ditambahkan');
    }
}
