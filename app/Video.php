<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';
    protected $fillable = ['name_video','url_video','kelas_id'];

    public function kelas()
    {
        return $this->belongsTo('App\Kelas');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'progress')->withPivot('completed_at')->withTimestamps();
    }
}
