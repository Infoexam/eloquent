<?php

namespace Infoexam\Eloquent\Observers;

use Infoexam\Eloquent\Models\Exam;

class ExamObserver
{
    /**
     * Listen to the Exam deleting event.
     *
     * @param Exam $exam
     *
     * @return void
     */
    public function deleting(Exam $exam): void
    {
        // Delete the questions for the exam.
        $exam->loadMissing('questions')
            ->questions
            ->each
            ->delete();
    }
}
