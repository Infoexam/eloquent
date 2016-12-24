<?php

namespace Infoexam\Eloquent\Observers;

use Infoexam\Eloquent\Models\Listing;

class ListingObserver
{
    /**
     * Listen to the Listing saving event.
     *
     * @param Listing $listing
     *
     * @return void
     */
    public function saving(Listing $listing)
    {
        // Fill the code and ended_at attributes.
        $code = sprintf('%s%s', $listing->getAttribute('began_at')->format('YmdHi'), $listing->getAttribute('room'));

        $key = is_null($listing->getAttribute('started_at')) ? 'began_at' : 'started_at';

        $ended_at = $listing->getAttribute($key)->copy()->addMinutes($listing->getAttribute('duration'));

        $listing->fill(compact('code', 'ended_at'));
    }
}
