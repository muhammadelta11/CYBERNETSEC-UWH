<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable = ['name', 'description'];

    public function upskillCategories()
    {
        return $this->hasMany('App\UpskillCategory');
    }
}
