<?php

namespace Infoexam\Eloquent\Models;

class Paper extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be normalized.
     *
     * @var array
     */
    protected $sensitivities = ['name'];

    /**
     * The questions that belong to the paper.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    /**
     * Get the listings for the paper.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
}
