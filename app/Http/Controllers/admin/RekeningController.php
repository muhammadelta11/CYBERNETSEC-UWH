<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RekeningController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Pengaturan Rekening',
            'rekening' => Rekening::all()
        ];

        return view('admin.rekening.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Rekening'
        ];

        return view('admin.rekening.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_rekening' => 'required|string|max:50|regex:/^[0-9]+$/',
            'atas_nama' => 'required|string|max:100|regex:/^[a-zA-Z\s\.\']+$/'
        ], [
            'no_rekening.regex' => 'Nomor rekening hanya boleh berisi angka',
            'atas_nama.regex' => 'Nama hanya boleh berisi huruf, spasi, titik, dan apostrof'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.rekening.create')->withErrors($validator)->withInput();
        }

        // Sanitize input
        $sanitizedData = [
            'no_rekening' => preg_replace('/[^0-9]/', '', $request->no_rekening),
            'atas_nama' => htmlspecialchars(strip_tags($request->atas_nama), ENT_QUOTES, 'UTF-8')
        ];

        Rekening::create($sanitizedData);
        return redirect()->route('admin.rekening')->with('status', 'Rekening berhasil ditambahkan');
    }

    public function edit($id)
    {
        $rekening = Rekening::findOrFail($id);
        $data = [
            'title' => 'Edit Rekening',
            'rekening' => $rekening
        ];

        return view('admin.rekening.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'no_rekening' => 'required|string|max:50|regex:/^[0-9]+$/',
            'atas_nama' => 'required|string|max:100|regex:/^[a-zA-Z\s\.\']+$/'
        ], [
            'no_rekening.regex' => 'Nomor rekening hanya boleh berisi angka',
            'atas_nama.regex' => 'Nama hanya boleh berisi huruf, spasi, titik, dan apostrof'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.rekening.edit', $id)->withErrors($validator)->withInput();
        }

        // Sanitize input
        $sanitizedData = [
            'no_rekening' => preg_replace('/[^0-9]/', '', $request->no_rekening),
            'atas_nama' => htmlspecialchars(strip_tags($request->atas_nama), ENT_QUOTES, 'UTF-8')
        ];

        $rekening = Rekening::findOrFail($id);
        $rekening->update($sanitizedData);
        return redirect()->route('admin.rekening')->with('status', 'Rekening berhasil diperbarui');
    }

    public function destroy($id)
    {
        $rekening = Rekening::findOrFail($id);
        $rekening->delete();
        return redirect()->route('admin.rekening')->with('status', 'Rekening berhasil dihapus');
    }
}
