<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Kelas;
use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KelasController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Master Kelas',
            'kelas' => Kelas::with('upskillCategory.semester')->get()
        ];

        return view('admin.kelas.index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Kelas',
            'upskillCategories' => \App\UpskillCategory::with('semester')->get()
        ];
        return view('admin.kelas.tambah', $data);
    }

    public function simpan(Request $request)
    {

        $validator = Validator($request->all(), [
            'name_kelas' => 'required',
            'type_kelas' => 'required',
            'upskill_category_id' => 'required|exists:upskill_categories,id',
            'description_kelas' => 'required',
            'thumbnail' => 'required|mimes:png,jpg,jpeg',
            'modul_file' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255'
        ]);

        if ($request->type_kelas == 3 || $request->type_kelas == 4) {
            $validator = Validator::make($request->all(), [
                'harga' => 'required|integer|min:0',
            ]);
        } else {
            $request->merge(['harga' => 0]);
        }

        if ($validator->fails()) {
            return redirect()->route('admin.kelas.tambah')->withErrors($validator)->withInput();
        } else {
            $file = $request->file('thumbnail')->store('thumbnail_kelas', 'public');
            $modulFilePath = null;
            if ($request->hasFile('modul_file')) {
                $modulFilePath = $request->file('modul_file')->store('modul_kelas', 'public');
            }
            $obj = [
                'name_kelas' => $request->name_kelas,
                'type_kelas' => $request->type_kelas,
                'upskill_category_id' => $request->upskill_category_id,
                'description_kelas' => $request->description_kelas,
                'harga' => $request->harga,
                'thumbnail' => $file,
                'modul_file' => $modulFilePath,
                'features' => $request->features ? json_encode($request->features) : null,
            ];
            Kelas::insert($obj);
            return redirect()->route('admin.kelas')->with('status', 'Berhasil Menambah Kelas Baru');
        }
    }

    public function detail($id)
    {
        $dec_id = Crypt::decrypt($id);
        $data = [
            'title' => 'Detail Kelas',
            'kelas' => Kelas::with('upskillCategory.semester')->find($dec_id)
        ];
        return view('admin.kelas.detail', $data);
    }

    public function hapus($id)
    {
        $dec_id = Crypt::decrypt($id);
        $kelas = Kelas::find($dec_id);
        Storage::delete('public/'.$kelas->thumbnail);
        Video::where('kelas_id', '=', $dec_id)->delete();
        $kelas->delete();
        return redirect()->route('admin.kelas')->with('status', 'Berhasil Menghapus Kelas');
    }

    public function edit($id)
    {
        $dec_id = Crypt::decrypt($id);
        $kelas = Kelas::find($dec_id);
        $data = [
            'title' => 'Edit Kelas',
            'kelas' => $kelas,
            'upskillCategories' => \App\UpskillCategory::with('semester')->get()
        ];
        return view('admin.kelas.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $dec_id = Crypt::decrypt($id);
        $validator = Validator($request->all(), [
            'name_kelas' => 'required',
            'type_kelas' => 'required',
            'upskill_category_id' => 'required|exists:upskill_categories,id',
            'description_kelas' => 'required',
            'thumbnail' => 'mimes:png,jpg,jpeg',
            'modul_file' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'features' => 'nullable|array',
            'features.*' => 'string|max:255'
        ]);

        if ($request->type_kelas == 3 || $request->type_kelas == 4) {
            $validator = Validator::make($request->all(), [
                'harga' => 'required|integer|min:0',
            ]);
        } else {
            $request->merge(['harga' => 0]);
        }

        if ($validator->fails()) {
            return redirect()->route('admin.kelas.edit', $id)->withErrors($validator)->withInput();
        } else {

            $kelas = Kelas::find($dec_id);
            if ($request->file('thumbnail')) {
                Storage::delete('public/'.$kelas->thumbnail);
                $file = $request->file('thumbnail')->store('thumbnail_kelas', 'public');
                $kelas->thumbnail = $file;
            }
            if ($request->file('modul_file')) {
                if ($kelas->modul_file) {
                    Storage::delete('public/'.$kelas->modul_file);
                }
                $modulFilePath = $request->file('modul_file')->store('modul_kelas', 'public');
                $kelas->modul_file = $modulFilePath;
            }
            $kelas->name_kelas = $request->name_kelas;
            $kelas->type_kelas = $request->type_kelas;
            $kelas->upskill_category_id = $request->upskill_category_id;
            $kelas->description_kelas = $request->description_kelas;
            $kelas->harga = $request->harga;
            $kelas->modul = $request->modul;
            $kelas->features = $request->features ? json_encode($request->features) : null;
            $kelas->save();
            return redirect()->route('admin.kelas.detail',$id)->with('status', 'Berhasil Memperbarui Kelas');
        }
    }

    public function tambahvideo($id)
    {
        $data = [
            'title' => 'Tambah Materi',
            'id' => $id
        ];

        return view('admin.kelas.tambahmateri',$data);
    }

    public function simpanvideo(Request $request,$id)
    {
        $validator = Validator($request->all(), [
            'title' => 'required',
            'type' => 'required|in:video,text,document',
            'content' => 'nullable',
            'url' => 'nullable',
            'file' => 'nullable|file|mimes:pdf,doc,docx,mp4,avi,mov|max:51200',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.kelas.tambahvideo',$id)->withErrors($validator)->withInput();
        } else {
            $kelasId = Crypt::decrypt($id);
            $materiData = [
                'kelas_id' => $kelasId,
                'title' => $request->title,
                'type' => $request->type,
                'content' => $request->content,
                'url' => $request->url,
            ];

            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('materi_files', 'local');
                $materiData['url'] = $filePath;
            }

            \App\Materi::create($materiData);

            return redirect()->route('admin.kelas.detail',$id)->with('status', 'Berhasil Menambah Materi');
        }
    }

    public function hapusvideo($id,$idkelas)
    {
        $dec_id = Crypt::decrypt($id);
        \App\Materi::where('id','=',$dec_id)->delete();
        return redirect()->route('admin.kelas.detail',$idkelas)->with('status', 'Berhasil Menghapus Materi');
    }

    public function upload(Request $request)
    {
        if($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/ckeditor_uploads', $filename);

            $url = asset('storage/ckeditor_uploads/' . $filename);

            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => 0, 'error' => ['message' => 'Upload failed']]);
    }
}
