<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Course extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name' , 'description' ,'user_id'
    ];
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
