<?php

namespace Infoexam\Eloquent\Observers;

use Infoexam\Eloquent\Models\Model;

class ModelObserver
{
    /**
     * Listen to the Model saving event.
     *
     * @param Model $model
     *
     * @return void
     */
    public function saving(Model $model)
    {
        // Transform empty string to null.
        foreach ($model->getAttributes() as $key => $value) {
            if (is_string($value) && empty($value)) {
                $model->setAttribute($key, null);
            }
        }

        // Replace sensitive characters to '-'.
        $search = ['\\', '/', '#', '　'];

        foreach ($model->getSensitivities() as $key) {
            $value = str_replace($search, '-', $model->getAttribute($key));

            $value = preg_replace('/\s+/', '-', $value);

            $model->setAttribute($key, $value);
        }
    }
}
