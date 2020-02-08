<?php

namespace Infoexam\Eloquent\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Infoexam\Media\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Exam extends Model implements HasMedia
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
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the questions for the exam.
     *
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }
}
