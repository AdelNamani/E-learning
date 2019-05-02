<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function chapters(){
        return $this->hasMany(Chapter::class);
    }

    public function get_lessons(){
        $all_lessons = collect([]);
        $chapters = $this->chapters;
        foreach ($chapters as $chapter){
            $lessons = $chapter->lessons;
            $all_lessons = $all_lessons->concat($lessons);
        }

        return $all_lessons;
    }


}
