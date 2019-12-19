<?php

namespace Infoexam\Eloquent\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
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
        'multiple' => 'boolean',
    ];

    /**
     * The attributes that should be normalized.
     *
     * @var array
     */
    protected $sensitivities = ['uuid'];

    /**
     * Get the difficulty that belongs to the question.
     *
     * @return BelongsTo
     */
    public function difficulty(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'difficulty_id');
    }

    /**
     * Get the options for the question.
     *
     * @return HasMany
     */
    public function options(): HasMany
    {
        return $this->hasMany(Option::class);
    }

    /**
     * Get the questions for the question.
     *
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(self::class);
    }

    /**
     * Get the exam that owns the question.
     *
     * @return BelongsTo
     */
    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    /**
     * The papers that belong to the question.
     *
     * @return BelongsToMany
     */
    public function papers(): BelongsToMany
    {
        return $this->belongsToMany(Paper::class);
    }
}
