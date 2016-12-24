<?php

namespace Infoexam\Eloquent\Models;

use Infoexam\Media\Media;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Exam extends Model implements HasMediaConversions
{
    use Media;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'enable' => 'boolean',
    ];

    /**
     * The attributes that should be normalized.
     *
     * @var array
     */
    protected $sensitivities = ['name'];

    /**
     * Get the category that belongs to the exam.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the questions for the exam.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
