<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    protected $table = 'progress';

    protected $fillable = [
        'user_id',
        'video_id',
        'materi_id',
        'completed_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function materi()
    {
        return $this->belongsTo('App\Materi');
    }
}
