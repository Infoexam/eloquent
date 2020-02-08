<?php

namespace Infoexam\Eloquent\Models;

use Illuminate\Database\Eloquent\Collection;

class Category extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Get filtered categories.
     *
     * @param null|string $category
     * @param null|string $name
     * @param bool $getKey
     *
     * @return Collection|mixed|null|string
     */
    public static function getCategories($category = null, $name = null, $getKey = true)
    {
        $categories = self::all();

        if (is_null($category)) {
            return $categories;
        }

        $categories = self::filterBy($categories, 'category', $category);

        if (is_null($name)) {
            return $categories;
        }

        $categories = self::filterBy($categories, 'name', $name)->first();

        if (is_null($categories)) {
            return null;
        } elseif (! $getKey) {
            return $categories;
        }

        return $categories->getKey();
    }

    /**
     * @param Collection $collection
     * @param string $column
     * @param mixed $value
     *
     * @return Collection
     */
    protected static function filterBy($collection, $column, $value): Collection
    {
        return $collection->filter(function (self $val) use ($column, $value) {
            return $value === $val->getAttribute($column);
        })->values();
    }
}
