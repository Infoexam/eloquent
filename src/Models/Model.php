<?php

namespace Infoexam\Eloquent\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent
{
    /**
     * The number of models to return for pagination.
     *
     * @var int
     */
    protected $perPage = 10;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be normalized.
     *
     * @var array
     */
    protected $sensitivities = [];

    /**
     * Get all of the sensitive attributes on the model.
     *
     * @return array
     */
    public function getSensitivities()
    {
        return $this->sensitivities;
    }
}
