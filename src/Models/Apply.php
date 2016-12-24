<?php

namespace Infoexam\Eloquent\Models;

class Apply extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['paid_at'];

    /**
     * Get the user that belongs to the apply.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the listing that belongs to the apply.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    /**
     * Get the result associated with the apply.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function result()
    {
        return $this->hasOne(Result::class);
    }
}
