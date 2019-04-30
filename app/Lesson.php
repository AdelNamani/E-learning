<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function chapter(){
        return $this->belongsTo('chapter');
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
