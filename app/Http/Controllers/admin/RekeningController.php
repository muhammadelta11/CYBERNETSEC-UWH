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
            'title' => 'Tambah Rekening',
            'paymentTypes' => ['bank_transfer' => 'Bank Transfer', 'gopay' => 'GoPay', 'dana' => 'DANA', 'ovo' => 'OVO', 'shopeepay' => 'ShopeePay'],
            'classTypes' => ['upskill' => 'Upskill', 'brainlabs' => 'Brainlabs', 'all' => 'Semua']
        ];

        return view('admin.rekening.create', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_rekening' => 'required|string|max:50',
            'atas_nama' => 'required|string|max:100|regex:/^[a-zA-Z\s\.\']+$/',
            'payment_type' => 'required|in:bank_transfer,gopay,dana,ovo,shopeepay',
            'class_type' => 'required|in:upskill,brainlabs,all'
        ], [
            'no_rekening.required' => 'Nomor rekening wajib diisi',
            'atas_nama.regex' => 'Nama hanya boleh berisi huruf, spasi, titik, dan apostrof',
            'payment_type.required' => 'Tipe pembayaran wajib dipilih',
            'class_type.required' => 'Tipe kelas wajib dipilih'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.rekening.create')->withErrors($validator)->withInput();
        }

        // Sanitize input
        $sanitizedData = [
            'no_rekening' => htmlspecialchars(strip_tags($request->no_rekening), ENT_QUOTES, 'UTF-8'),
            'atas_nama' => htmlspecialchars(strip_tags($request->atas_nama), ENT_QUOTES, 'UTF-8'),
            'payment_type' => $request->payment_type,
            'class_type' => $request->class_type
        ];

        Rekening::create($sanitizedData);
        return redirect()->route('admin.rekening')->with('status', 'Rekening berhasil ditambahkan');
    }

    public function edit($id)
    {
        $rekening = Rekening::findOrFail($id);
        $data = [
            'title' => 'Edit Rekening',
            'rekening' => $rekening,
            'paymentTypes' => ['bank_transfer' => 'Bank Transfer', 'gopay' => 'GoPay', 'dana' => 'DANA', 'ovo' => 'OVO', 'shopeepay' => 'ShopeePay'],
            'classTypes' => ['upskill' => 'Upskill', 'brainlabs' => 'Brainlabs', 'all' => 'Semua']
        ];

        return view('admin.rekening.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'no_rekening' => 'required|string|max:50',
            'atas_nama' => 'required|string|max:100|regex:/^[a-zA-Z\s\.\']+$/',
            'payment_type' => 'required|in:bank_transfer,gopay,dana,ovo,shopeepay',
            'class_type' => 'required|in:upskill,brainlabs,all'
        ], [
            'no_rekening.required' => 'Nomor rekening wajib diisi',
            'atas_nama.regex' => 'Nama hanya boleh berisi huruf, spasi, titik, dan apostrof',
            'payment_type.required' => 'Tipe pembayaran wajib dipilih',
            'class_type.required' => 'Tipe kelas wajib dipilih'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.rekening.edit', $id)->withErrors($validator)->withInput();
        }

        // Sanitize input
        $sanitizedData = [
            'no_rekening' => htmlspecialchars(strip_tags($request->no_rekening), ENT_QUOTES, 'UTF-8'),
            'atas_nama' => htmlspecialchars(strip_tags($request->atas_nama), ENT_QUOTES, 'UTF-8'),
            'payment_type' => $request->payment_type,
            'class_type' => $request->class_type
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
