<?php

namespace Infoexam\Eloquent\Models;

use Carbon\Carbon;

class Listing extends Model
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
    protected $dates = ['began_at', 'ended_at', 'started_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'applicable' => 'boolean',
    ];

    /**
     * Set the listing's began at.
     *
     * @param string $value
     *
     * @return void
     */
    public function setBeganAtAttribute($value)
    {
        $this->attributes['began_at'] = Carbon::parse($value);
    }

    /**
     * Get the listing's log.
     *
     * @param string $value
     *
     * @return Paper
     */
    public function getLogAttribute($value)
    {
        return unserialize($value);
    }

    /**
     * Set the listing's log.
     *
     * @param Paper $value
     *
     * @return void
     */
    public function setLogAttribute($value)
    {
        $this->attributes['log'] = serialize($value);
    }

    /**
     * Get the apply type that belongs to the listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function applyType()
    {
        return $this->belongsTo(Category::class, 'apply_type_id');
    }

    /**
     * Get the subject that belongs to the listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subject()
    {
        return $this->belongsTo(Category::class, 'subject_id');
    }

    /**
     * Get the paper that owns the listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function paper()
    {
        return $this->belongsTo(Paper::class);
    }

    /**
     * Get the applies for the listing.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function applies()
    {
        return $this->hasMany(Apply::class);
    }
}
