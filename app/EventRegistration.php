<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $table = 'event_registrations';

    protected $fillable = [
        'user_id',
        'event_id',
        'status',
        'amount_paid',
        'payment_proof',
        'registered_at'
    ];

    protected $casts = [
        'registered_at' => 'datetime',
        'amount_paid' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function event()
    {
        return $this->belongsTo('App\Podcast', 'event_id');
    }
}
