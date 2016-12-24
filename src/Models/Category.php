<?php

namespace Infoexam\Eloquent\Models;

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
     * @return \Illuminate\Database\Eloquent\Collection|mixed|null|string
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
     * @param \Illuminate\Database\Eloquent\Collection $collection
     * @param string $column
     * @param mixed $value
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected static function filterBy($collection, $column, $value)
    {
        return $collection->filter(function (self $val) use ($column, $value) {
            return $value === $val->getAttribute($column);
        })->values();
    }
}
