<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class SemesterController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Master Semester',
            'semesters' => Semester::all()
        ];

        return view('admin.semesters.index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Semester',
        ];
        return view('admin.semesters.tambah', $data);
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.semesters.tambah')->withErrors($validator)->withInput();
        } else {
            Semester::create($request->only(['name', 'description']));
            return redirect()->route('admin.semesters')->with('status', 'Berhasil Menambah Semester Baru');
        }
    }

    public function detail($id)
    {
        $dec_id = Crypt::decrypt($id);
        $data = [
            'title' => 'Detail Semester',
            'semester' => Semester::find($dec_id)
        ];
        return view('admin.semesters.detail', $data);
    }

    public function hapus($id)
    {
        $dec_id = Crypt::decrypt($id);
        $semester = Semester::find($dec_id);
        $semester->delete();
        return redirect()->route('admin.semesters')->with('status', 'Berhasil Menghapus Semester');
    }

    public function edit($id)
    {
        $dec_id = Crypt::decrypt($id);
        $semester = Semester::find($dec_id);
        $data = [
            'title' => 'Edit Semester',
            'semester' => $semester
        ];
        return view('admin.semesters.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $dec_id = Crypt::decrypt($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.semesters.edit', $id)->withErrors($validator)->withInput();
        } else {
            $semester = Semester::find($dec_id);
            $semester->update($request->only(['name', 'description']));
            return redirect()->route('admin.semesters.detail', $id)->with('status', 'Berhasil Memperbarui Semester');
        }
    }
}
