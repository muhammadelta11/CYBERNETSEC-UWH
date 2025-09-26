<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\EventRegistration;
use App\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class EventRegistrationController extends Controller
{
    public function index()
    {
        $registrations = EventRegistration::with(['user', 'event'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $data = [
            'registrations' => $registrations,
            'title' => 'Event Registrations'
        ];

        return view('admin.event_registrations.index', $data);
    }

    public function show($id)
    {
        $dec_id = Crypt::decrypt($id);
        $registration = EventRegistration::with(['user', 'event'])->find($dec_id);

        if (!$registration) {
            return redirect()->route('admin.event-registrations.index')->with('error', 'Registration not found');
        }

        $data = [
            'registration' => $registration,
            'title' => 'Event Registration Detail'
        ];

        return view('admin.event_registrations.show', $data);
    }

    public function updateStatus(Request $request, $id)
    {
        $dec_id = Crypt::decrypt($id);
        $registration = EventRegistration::find($dec_id);

        if (!$registration) {
            return response()->json([
                'success' => false,
                'message' => 'Registration not found'
            ]);
        }

        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        $registration->update([
            'status' => $request->status
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Registration status updated successfully'
        ]);
    }

    public function uploadPaymentProof(Request $request, $id)
    {
        $dec_id = Crypt::decrypt($id);
        $registration = EventRegistration::find($dec_id);

        if (!$registration) {
            return redirect()->back()->with('error', 'Registration not found');
        }

        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = time() . '_' . $registration->id . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/payment_proofs'), $filename);

            $registration->update([
                'payment_proof' => 'payment_proofs/' . $filename
            ]);
        }

        return redirect()->back()->with('success', 'Payment proof uploaded successfully');
    }

    public function confirmPayment($id)
    {
        $dec_id = Crypt::decrypt($id);
        $registration = EventRegistration::find($dec_id);

        if (!$registration) {
            return redirect()->back()->with('error', 'Registration not found');
        }

        $registration->update([
            'status' => 'confirmed'
        ]);

        return redirect()->back()->with('success', 'Payment confirmed and registration approved');
    }

    public function rejectPayment($id)
    {
        $dec_id = Crypt::decrypt($id);
        $registration = EventRegistration::find($dec_id);

        if (!$registration) {
            return redirect()->back()->with('error', 'Registration not found');
        }

        $registration->update([
            'status' => 'cancelled'
        ]);

        return redirect()->back()->with('success', 'Payment rejected and registration cancelled');
    }
}
