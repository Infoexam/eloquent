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

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $model) {
            $attributes = $model->getAttributes();

            // Transform empty string to null.
            foreach ($attributes as $key => $value) {
                if (is_string($value) && empty($value)) {
                    $model->setAttribute($key, null);
                }
            }

            // Replace sensitive characters to '-'.
            $search = ['\\', '/', '#', '　'];

            foreach ($model->getSensitivities() as $key) {
                if (! isset($attributes[$key])) {
                    continue;
                }

                $value = str_replace($search, '-', $model->getAttribute($key));

                $value = preg_replace('/\s+/', '-', $value);

                $model->setAttribute($key, $value);
            }
        });
    }
}
