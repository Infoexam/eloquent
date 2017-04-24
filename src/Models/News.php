<?php

namespace Infoexam\Eloquent\Models;

class News extends Model
{
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_announcement' => 'boolean',
    ];

    /**
     * The attributes that should be normalized.
     *
     * @var array
     */
    protected $sensitivities = ['heading'];
}
