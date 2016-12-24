<?php

namespace Infoexam\Eloquent\Observers;

use Infoexam\Eloquent\Models\Paper;

class PaperObserver
{
    /**
     * Listen to the Paper deleting event.
     *
     * @param Paper $paper
     *
     * @return void
     */
    public function deleting(Paper $paper)
    {
        // Delete the questions for the paper.
        $paper->questions()->detach();
    }
}
