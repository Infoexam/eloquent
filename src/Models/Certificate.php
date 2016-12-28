<?php

namespace Infoexam\Eloquent\Models;

class Certificate extends Model
{
    /**
     * Get the category that belongs to the certificate.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
