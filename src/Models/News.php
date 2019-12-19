<?php

namespace Infoexam\Eloquent\Models;

use Hashids\Hashids;

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

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['url'];

    /**
     * Get the user's first name.
     *
     * @return string
     */
    public function getUrlAttribute(): string
    {
        $hashids = new Hashids('maOn20BAcIkOF8Uiw8vABepn6gqS6bTN', 6);

        $encode = $hashids->encode($this->getKey());

        return sprintf('%s-%s', $this->getAttribute('heading'), $encode);
    }
}
