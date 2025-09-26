<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EventRegistrationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $registrations = EventRegistration::with('event')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('front.event_registrations.index', compact('registrations'));
    }

    public function show($id)
    {
        $dec_id = \Crypt::decrypt($id);
        $user = Auth::user();

        $registration = EventRegistration::with('event')
            ->where('id', $dec_id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        return view('front.event_registrations.show', compact('registration'));
    }

    public function uploadPaymentProof(Request $request, $id)
    {
        $dec_id = \Crypt::decrypt($id);
        $user = Auth::user();

        $registration = EventRegistration::where('id', $dec_id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // Only allow upload if payment proof is rejected or doesn't exist yet
        if (($registration->status != 'rejected' && $registration->payment_proof) || $registration->amount_paid <= 0) {
            return redirect()->back()->with('error', 'Tidak dapat upload bukti pembayaran untuk pendaftaran ini.');
        }

        $validator = Validator::make($request->all(), [
            'payment_proof' => 'required|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Delete old payment proof if exists
        if ($registration->payment_proof) {
            Storage::delete('public/' . $registration->payment_proof);
        }

        // Store new payment proof
        $file = $request->file('payment_proof')->store('payment_proofs', 'public');
        $registration->payment_proof = $file;
        $registration->save();

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload. Menunggu konfirmasi dari admin.');
    }
}
