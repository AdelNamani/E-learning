<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }

    /**
     * Return propositions for this question
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function propositions(){
        return $this->hasMany(Proposition::class);
    }

    /**
     * Return the answer of this question
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function proposition(){
        return $this->hasOne(Proposition::class);
    }
}
