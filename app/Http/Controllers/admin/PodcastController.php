<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class PodcastController extends Controller
{
    public function index()
    {
        $data = [
            'podcasts' => Podcast::all(),
            'title' => 'Jadwal Event'
        ];

        return view('admin.podcast.index', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Tambah Event'
        ];

        return view('admin.podcast.tambah', $data);
    }

    public function simpan(Request $request)
    {
            $validator = Validator($request->all(), [
                'name_event' => 'required',
                'event_date' => 'required|date',
                'event_time' => 'nullable|date_format:H:i',
                'location' => 'nullable|string|max:255',
                'speaker' => 'nullable|string|max:255',
                'max_participants' => 'nullable|integer|min:1',
                'registration_fee' => 'nullable|numeric|min:0',
                'event_type' => 'required|in:online,offline,hybrid',
                'meeting_link' => 'nullable|url',
                'description_event' => 'required',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'is_event' => 'nullable|boolean',
                'quota' => 'nullable|integer|min:1',
                'registration_open' => 'nullable|date',
                'registration_close' => 'nullable|date|after:registration_open'
            ]);

        if ($validator->fails()) {
            return redirect()->route('admin.podcast.tambah')->withErrors($validator)->withInput();
        } else {
            $data = [
                'name_podcast' => $request->name_event,
                'url_podcast' => '', // Default empty value for legacy field
                'event_date' => $request->event_date,
                'event_time' => $request->event_time,
                'location' => $request->location,
                'speaker' => $request->speaker,
                'max_participants' => $request->max_participants,
                'registration_fee' => $request->registration_fee,
                'event_type' => $request->event_type ?? 'online',
                'meeting_link' => $request->meeting_link,
                'description_podcast' => $request->description_event,
                'is_event' => $request->has('is_event') ? 1 : 0,
                'quota' => $request->quota,
                'registration_open' => $request->registration_open,
                'registration_close' => $request->registration_close,
            ];

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('event_thumbnails', 'public');
                $data['thumbnail'] = $thumbnailPath;
            }

            Podcast::insert($data);
            return redirect()->route('admin.podcast')->with('status', 'Berhasil Menambah Event');
        }
    }

    public function detail($id)
    {
        $dec_id = Crypt::decrypt($id);
        $data = [
            'podcast' => Podcast::find($dec_id),
            'title' => 'Detail Event'
        ];

        return view('admin.podcast.detail', $data);
    }

    public function hapus($id)
    {
        $dec_id = Crypt::decrypt($id);
        Podcast::where('id','=',$dec_id)->delete();
        return redirect()->route('admin.podcast')->with('status', 'Berhasil Menghapus Event');
    }

    public function edit($id)
    {
        $dec_id = Crypt::decrypt($id);
        $data = [
            'podcast' => Podcast::find($dec_id),
            'title' => 'Edit Event',
            'id' => $id
        ];

        return view('admin.podcast.edit', $data);
    }

    public function update(Request $request,$id)
    {
        $dec_id = Crypt::decrypt($id);
        $validator = Validator($request->all(), [
            'name_event' => 'required',
            'event_date' => 'required|date',
            'event_time' => 'nullable|date_format:H:i',
            'location' => 'nullable|string|max:255',
            'speaker' => 'nullable|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'registration_fee' => 'nullable|numeric|min:0',
            'event_type' => 'required|in:online,offline,hybrid',
            'meeting_link' => 'nullable|url',
            'description_event' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_event' => 'nullable|boolean',
            'quota' => 'nullable|integer|min:1',
            'registration_open' => 'nullable|date',
            'registration_close' => 'nullable|date|after:registration_open'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.podcast.edit',$id)->withErrors($validator)->withInput();
        } else {
            $obj = [
                'name_podcast' => $request->name_event,
                'event_date' => $request->event_date,
                'event_time' => $request->event_time,
                'location' => $request->location,
                'speaker' => $request->speaker,
                'max_participants' => $request->max_participants,
                'registration_fee' => $request->registration_fee,
                'event_type' => $request->event_type,
                'meeting_link' => $request->meeting_link,
                'description_podcast' => $request->description_event,
                'is_event' => $request->has('is_event') ? 1 : 0,
                'quota' => $request->quota,
                'registration_open' => $request->registration_open,
                'registration_close' => $request->registration_close,
            ];

            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('event_thumbnails', 'public');
                $obj['thumbnail'] = $thumbnailPath;
            }

            Podcast::where('id','=',$dec_id)->update($obj);
            return redirect()->route('admin.podcast')->with('status', 'Berhasil Memperbarui Event');
        }
    }
}
