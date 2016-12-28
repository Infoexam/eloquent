<?php

namespace Infoexam\Eloquent;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Infoexam\Media\MediaServiceProvider;
use Infoexam\Password\PasswordServiceProvider;

class EloquentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            Models\User::class,
            Models\Certificate::class,
            Models\Receipt::class,

            Models\Exam::class,
            Models\Question::class,
            Models\Option::class,
            Models\Paper::class,
            Models\Listing::class,
            Models\Apply::class,
            Models\Result::class,

            Models\Category::class,
            Models\Config::class,
        ]);

        Models\Receipt::observe(Observers\ReceiptObserver::class);

        Models\Exam::observe(Observers\ExamObserver::class);
        Models\Question::observe(Observers\QuestionObserver::class);
        Models\Paper::observe(Observers\PaperObserver::class);
        Models\Listing::observe(Observers\ListingObserver::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(MediaServiceProvider::class);
        $this->app->register(PasswordServiceProvider::class);
    }
}
