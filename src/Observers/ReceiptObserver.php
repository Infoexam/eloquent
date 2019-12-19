<?php

namespace Infoexam\Eloquent\Observers;

use Carbon\Carbon;
use Infoexam\Eloquent\Models\Receipt;

class ReceiptObserver
{
    /**
     * Listen to the Receipt creating event.
     *
     * @param Receipt $receipt
     *
     * @return void
     */
    public function creating(Receipt $receipt): void
    {
        $receipt->setAttribute('created_at', Carbon::now());
    }
}
