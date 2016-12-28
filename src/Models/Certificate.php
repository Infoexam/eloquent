<?php

namespace Infoexam\Eloquent\Models;

class Certificate extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'score' => 'real',
    ];

    /**
     * Get the category that belongs to the certificate.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
