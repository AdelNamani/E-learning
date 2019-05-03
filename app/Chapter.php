<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function lessons(){
        return $this->hasMany(Lesson::class);
    }

    public function users(){
        return $this->belongsToMany(User::class)->withTimestamps();;
    }

    public function questions(){
        return $this->hasMany(Question::class);
    }
}
