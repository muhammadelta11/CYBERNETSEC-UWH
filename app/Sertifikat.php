<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    protected $table = 'sertifikats';

    protected $fillable = [
        'user_id',
        'nama_sertifikat',
        'tanggal_diterbitkan',
        'file_sertifikat',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
