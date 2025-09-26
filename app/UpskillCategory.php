<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpskillCategory extends Model
{
    protected $fillable = ['name', 'semester_id', 'description'];

    public function semester()
    {
        return $this->belongsTo('App\Semester');
    }

    public function kelas()
    {
        return $this->hasMany('App\Kelas');
    }
}
