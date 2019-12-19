<?php

namespace Infoexam\Eloquent\Observers;

use Infoexam\Eloquent\Models\Exam;
use Infoexam\Eloquent\Models\Question;

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
        $exam->load(['questions'])
            ->getRelation('questions')
            ->each(function (Question $question) {
                $question->delete();
            });
    }
}
