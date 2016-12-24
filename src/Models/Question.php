<?php

namespace Infoexam\Eloquent\Models;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function difficulty()
    {
        return $this->belongsTo(Category::class, 'difficulty_id');
    }

    /**
     * Get the options for the question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function options()
    {
        return $this->hasMany(Option::class);
    }

    /**
     * Get the questions for the question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany(self::class);
    }

    /**
     * Get the exam that owns the question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    /**
     * The papers that belong to the question.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function papers()
    {
        return $this->belongsToMany(Paper::class);
    }
}
