<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Rekening;
use App\Transaksi;
use App\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index()
    {
        $setting = \App\Setting::first();
        if (!$setting) {
            $setting = new \stdClass();
            $setting->harga = 0;
        }
        $data = [
            'rekening' => Rekening::all(),
            'setting' => $setting
        ];
        return view('front.transaksi.index',$data);
    }

    public function uploadbukti(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'bukti' => 'required|mimes:png,jpg,jpeg|max:2048' // 2MB max
        ]);

        if ($validator->fails()) {
            return redirect('upgradepremium')->withErrors($validator)->withInput();
        }else{

            $file = $request->file('bukti');

            // Additional security checks
            if (!$this->isValidImage($file)) {
                return redirect('upgradepremium')->withErrors(['bukti' => 'File tidak valid atau rusak'])->withInput();
            }

            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('buktitf', $fileName, 'public');

            $obj = [
                'users_id' => Auth::user()->id,
                'status' => '0',
                'bukti_transfer' => $filePath
            ];

            Transaksi::create($obj);
            return redirect('upgradepremium')->with('status','Berhasil Mengirim Bukti Transfer');
        }
    }

    public function uploadulang(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'bukti' => 'required|mimes:png,jpg,jpeg'
        ]);

        if ($validator->fails()) {
            return redirect('upgradepremium')->withErrors($validator)->withInput();
        }else{

            $file = $request->file('bukti')->store('buktitf','public');
            $obj = [
                'users_id' => Auth::user()->id,
                'status' => '0',
                'bukti_transfer' => $file
            ];

            Transaksi::where('id','=',Auth::user()->id)->update($obj);
            return redirect('upgradepremium')->with('status','Berhasil Mengirim Ulang Transfer');
        }
    }

    public function bayarKelas($id)
    {
        $kelas = \App\Kelas::with('upskillCategory')->findOrFail($id);

        // Filter rekening based on class type
        $classType = $kelas->type_kelas == 4 ? 'brainlabs' : 'upskill';
        $rekening = \App\Rekening::where('class_type', $classType)
            ->orWhere('class_type', 'all')
            ->get();

        $data = [
            'kelas' => $kelas,
            'rekening' => $rekening
        ];
        return view('front.transaksi.kelas', $data);
    }

    public function uploadBuktiKelas(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'bukti' => 'required|mimes:png,jpg,jpeg'
        ]);

        if ($validator->fails()) {
            return redirect()->route('transaksi.kelas', $id)->withErrors($validator)->withInput();
        }else{

            $kelas = \App\Kelas::findOrFail($id);
            $file = $request->file('bukti')->store('buktitf','public');
            $obj = [
                'users_id' => Auth::user()->id,
                'kelas_id' => $kelas->id,
                'harga' => $kelas->harga,
                'status' => '0',
                'bukti_transfer' => $file
            ];

            Transaksi::create($obj);
            return redirect()->route('transaksi.kelas', $id)->with('status','Berhasil Mengirim Bukti Transfer untuk Kelas');
        }
    }

    public function kirimTanpaBukti(Request $request, $id)
    {
        $kelas = \App\Kelas::findOrFail($id);
        
        // Check for existing transaction with pending or rejected status
        $existing = \App\Transaksi::where('users_id', Auth::user()->id)
                             ->where('kelas_id', $kelas->id)
                             ->whereIn('status', [0, 2])
                             ->first();
        
        if ($existing) {
            // Update existing transaction: set status to pending (0) and update timestamp
            $existing->status = 0;
            $existing->tanggal = now();
            $existing->save();
        } else {
            // Create new transaction if none exists with pending/rejected status
            $obj = [
                'users_id' => Auth::user()->id,
                'kelas_id' => $kelas->id,
                'harga' => $kelas->harga,
                'status' => 0,
                'bukti_transfer' => null
            ];
            \App\Transaksi::create($obj);
        }
        
        return redirect()->route('transaksi.kelas.daftar', $id);
    }

    public function daftarKelas($id)
    {
        $kelas = \App\Kelas::with('upskillCategory')->findOrFail($id);

        // Filter rekening based on class type
        $classType = $kelas->type_kelas == 4 ? 'brainlabs' : 'upskill';
        $rekening = \App\Rekening::where('class_type', $classType)
            ->orWhere('class_type', 'all')
            ->get();

        $data = [
            'kelas' => $kelas,
            'rekening' => $rekening
        ];
        return view('front.transaksi.daftar-kelas', $data);
    }

    public function kirimNotifikasi(Request $request)
    {
        $setting = \App\Setting::first();
        if (!$setting) {
            $setting = new \stdClass();
            $setting->harga = 0;
        }
        $obj = [
            'users_id' => Auth::user()->id,
            'harga' => $setting->harga,
            'status' => '0',
            'bukti_transfer' => null
        ];

        Transaksi::create($obj);
        return redirect('upgradepremium')->with('status','Berhasil Mengirim Notifikasi Pembayaran untuk Upgrade Premium');
    }

    /**
     * Validate if uploaded file is a valid image
     */
    private function isValidImage($file)
    {
        // Check file size (additional check)
        if ($file->getSize() > 2097152) { // 2MB
            return false;
        }

        // Get image info
        $imageInfo = getimagesize($file->getRealPath());

        if (!$imageInfo) {
            return false;
        }

        // Check if it's actually an image
        $allowedTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_JPG];
        if (!in_array($imageInfo[2], $allowedTypes)) {
            return false;
        }

        // Check mime type matches extension
        $mimeType = $file->getMimeType();
        $extension = strtolower($file->getClientOriginalExtension());

        $mimeToExt = [
            'image/jpeg' => ['jpg', 'jpeg'],
            'image/png' => ['png']
        ];

        if (!isset($mimeToExt[$mimeType]) || !in_array($extension, $mimeToExt[$mimeType])) {
            return false;
        }

        return true;
    }
}
