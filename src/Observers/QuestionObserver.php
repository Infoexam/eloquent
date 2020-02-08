<?php

namespace Infoexam\Eloquent\Observers;

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
    public function deleting(Question $question): void
    {
        $question->loadMissing(['questions', 'options']);

        // Delete the sub questions for the question.
        $question->questions->each->delete();

        // Delete the options for the question.
        $question->options->each->delete();
    }
}
