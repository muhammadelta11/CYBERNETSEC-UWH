<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Master Blog Categories',
            'categories' => BlogCategory::all()
        ];

        return view('admin.blog_categories.index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Blog Category',
        ];
        return view('admin.blog_categories.tambah', $data);
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:blog_categories,name',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.blog_categories.tambah')->withErrors($validator)->withInput();
        } else {
            BlogCategory::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);
            return redirect()->route('admin.blog_categories')->with('status', 'Berhasil Menambah Blog Category Baru');
        }
    }

    public function edit($id)
    {
        $dec_id = decrypt($id);
        $data = [
            'title' => 'Edit Blog Category',
            'category' => BlogCategory::find($dec_id)
        ];
        return view('admin.blog_categories.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $dec_id = decrypt($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:blog_categories,name,' . $dec_id,
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.blog_categories.edit', $id)->withErrors($validator)->withInput();
        } else {
            $category = BlogCategory::find($dec_id);
            $category->name = $request->name;
            $category->slug = Str::slug($request->name);
            $category->save();
            return redirect()->route('admin.blog_categories')->with('status', 'Berhasil Memperbarui Blog Category');
        }
    }

    public function hapus($id)
    {
        $dec_id = decrypt($id);
        $category = BlogCategory::find($dec_id);

        // Check if category is being used by any blogs
        if ($category->blogs()->count() > 0) {
            return redirect()->route('admin.blog_categories')->with('error', 'Tidak dapat menghapus kategori yang masih digunakan oleh blog');
        }

        $category->delete();
        return redirect()->route('admin.blog_categories')->with('status', 'Berhasil Menghapus Blog Category');
    }
}
