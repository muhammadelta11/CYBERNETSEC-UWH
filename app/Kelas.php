<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';
    protected $fillable = ['name_kelas', 'type_kelas', 'description_kelas', 'thumbnail', 'harga', 'modul', 'modul_file', 'upskill_category_id', 'features'];

    public function video()
    {
        return $this->hasMany('App\Video');
    }

    public function materi()
    {
        return $this->hasMany('App\Materi')->orderBy('order');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'user_kelas')->withTimestamps();
    }

    public function upskillCategory()
    {
        return $this->belongsTo('App\UpskillCategory');
    }
}
