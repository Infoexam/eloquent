<?php

namespace Infoexam\Eloquent\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
     * @return BelongsTo
     *
     * @codeCoverageIgnore
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the listing that belongs to the apply.
     *
     * @return BelongsTo
     *
     * @codeCoverageIgnore
     */
    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }

    /**
     * Get the result associated with the apply.
     *
     * @return HasOne
     *
     * @codeCoverageIgnore
     */
    public function result(): HasOne
    {
        return $this->hasOne(Result::class);
    }
}
