<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Podcast extends Model
{
    protected $table = 'podcast';
    protected $fillable = [
        'name_event',
        'event_date',
        'event_time',
        'location',
        'speaker',
        'max_participants',
        'registration_fee',
        'event_type',
        'meeting_link',
        'thumbnail',
        'description_event',
        'is_event',
        'quota',
        'registration_open',
        'registration_close'
    ];
}
