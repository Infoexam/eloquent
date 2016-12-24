<?php

namespace Infoexam\Eloquent\Observers;

use Infoexam\Eloquent\Models\Option;
use Infoexam\Eloquent\Models\Question;

class QuestionObserver
{
    /**
     * Listen to the Question deleting event.
     *
     * @param Question $question
     *
     * @return void
     */
    public function deleting(Question $question)
    {
        $question->load(['questions', 'options']);

        // Delete the sub questions for the question.
        $question->getRelation('questions')
            ->each(function (Question $question) {
                $question->delete();
            });

        // Delete the options for the question.
        $question->getRelation('options')
            ->each(function (Option $option) {
                $option->delete();
            });
    }
}
