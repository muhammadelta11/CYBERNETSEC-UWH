<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        if (!$setting) {
            $setting = new \stdClass();
            $setting->about = '';
            $setting->harga = 0;
            $setting->registration_enabled = true;
        }
        $data = [
            'title' => 'Pengaturan',
            'setting' => $setting
        ];

        return view('admin.pengaturan.index',$data);
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'about' => 'required',
            'harga' => 'required|numeric',
            'registration_enabled' => 'nullable|boolean'
        ]);

        if($validator->fails()){
            return redirect()->route('admin.setting')->withErrors($validator)->withInput();
        }else{
            $setting = Setting::first();
            $registrationEnabled = $request->has('registration_enabled') ? 1 : 0;
            if ($setting) {
                $setting->update([
                    'about' => $request->about,
                    'harga' => $request->harga,
                    'registration_enabled' => $registrationEnabled
                ]);
            } else {
                Setting::create([
                    'about' => $request->about,
                    'harga' => $request->harga,
                    'registration_enabled' => $registrationEnabled
                ]);
            }
            return redirect()->route('admin.setting')->with('status','Berhasil Memperbarui Pengaturan');
        }
    }
}
