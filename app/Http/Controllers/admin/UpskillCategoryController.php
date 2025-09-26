<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\UpskillCategory;
use App\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class UpskillCategoryController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Master Upskill Categories',
            'upskillCategories' => UpskillCategory::with('semester')->get()
        ];

        return view('admin.upskill_categories.index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Upskill Category',
            'semesters' => Semester::all()
        ];
        return view('admin.upskill_categories.tambah', $data);
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'semester_id' => 'required|exists:semesters,id',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.upskill_categories.tambah')->withErrors($validator)->withInput();
        } else {
            UpskillCategory::create($request->only(['name', 'semester_id', 'description']));
            return redirect()->route('admin.upskill_categories')->with('status', 'Berhasil Menambah Upskill Category Baru');
        }
    }

    public function detail($id)
    {
        $dec_id = Crypt::decrypt($id);
        $data = [
            'title' => 'Detail Upskill Category',
            'upskillCategory' => UpskillCategory::with('semester')->find($dec_id)
        ];
        return view('admin.upskill_categories.detail', $data);
    }

    public function hapus($id)
    {
        $dec_id = Crypt::decrypt($id);
        $upskillCategory = UpskillCategory::find($dec_id);
        $upskillCategory->delete();
        return redirect()->route('admin.upskill_categories')->with('status', 'Berhasil Menghapus Upskill Category');
    }

    public function edit($id)
    {
        $dec_id = Crypt::decrypt($id);
        $upskillCategory = UpskillCategory::find($dec_id);
        $data = [
            'title' => 'Edit Upskill Category',
            'upskillCategory' => $upskillCategory,
            'semesters' => Semester::all()
        ];
        return view('admin.upskill_categories.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $dec_id = Crypt::decrypt($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'semester_id' => 'required|exists:semesters,id',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.upskill_categories.edit', $id)->withErrors($validator)->withInput();
        } else {
            $upskillCategory = UpskillCategory::find($dec_id);
            $upskillCategory->update($request->only(['name', 'semester_id', 'description']));
            return redirect()->route('admin.upskill_categories.detail', $id)->with('status', 'Berhasil Memperbarui Upskill Category');
        }
    }
}
