<?php

namespace Infoexam\Eloquent\Models;

class Attachment extends Model
{
    /**
     * Get all of the owning attachmentable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function attachmentable()
    {
        return $this->morphTo();
    }
}
