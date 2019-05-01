<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

}
