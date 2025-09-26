<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Podcast;
use App\EventRegistration;
use Illuminate\Http\Request;

class PodcastController extends Controller
{
    public function index()
    {
        $podcasts = Podcast::latest()->paginate(12);

        return view('front.podcast.index', compact('podcasts'));
    }

    public function detail($id)
    {
        $dec_id = \Crypt::decrypt($id);
        $podcast = Podcast::findOrFail($dec_id);

        // Count number of users registered for this podcast event
        $registrationCount = EventRegistration::where('event_id', $dec_id)->count();

        // Check if user is registered for this event
        $isRegistered = false;
        $registration = null;

        if (auth()->check()) {
            $registration = EventRegistration::where('user_id', auth()->id())
                ->where('event_id', $dec_id)
                ->first();

            $isRegistered = $registration !== null;
        }

        return view('front.podcast.detail', compact('podcast', 'registrationCount', 'isRegistered', 'registration'));
    }

    public function register(Request $request, $id)
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda belum login',
                'redirect' => route('login')
            ], 401);
        }

        $dec_id = \Crypt::decrypt($id);

        // Check if user is already registered
        $existingRegistration = EventRegistration::where('user_id', auth()->id())
            ->where('event_id', $dec_id)
            ->first();

        if ($existingRegistration) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah terdaftar untuk event ini.'
            ]);
        }

        // Get the event to check registration fee
        $event = Podcast::findOrFail($dec_id);

        // Create new registration
        EventRegistration::create([
            'user_id' => auth()->id(),
            'event_id' => $dec_id,
            'status' => 'pending',
            'amount_paid' => $event->registration_fee > 0 ? $event->registration_fee : null,
            'registered_at' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pendaftaran berhasil! Silakan upload bukti pembayaran.',
            'requires_payment' => true
        ]);
    }
}
