<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserKelas extends Model
{
    protected $table = 'user_kelas';
    protected $fillable = ['user_id', 'kelas_id', 'enrolled_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function kelas()
    {
        return $this->belongsTo('App\Kelas');
    }
}
