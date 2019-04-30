<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proposition extends Model
{

    /**
     * Return the question this proposition is for.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question(){
        return $this->belongsTo(Question::class);
    }
}
