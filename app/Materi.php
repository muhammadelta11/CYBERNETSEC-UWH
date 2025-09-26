<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';

    protected $fillable = [
        'kelas_id',
        'type',
        'title',
        'content',
        'url',
        'order',
    ];

    public function kelas()
    {
        return $this->belongsTo('App\Kelas');
    }
}
