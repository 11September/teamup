<?php

namespace App\Providers;

use App\Feedback;
use App\Repositories\FeedbackRepository;
use App\Services\FeedbackService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */


    public function register()
    {
        view()->composer('partials.dashboard_feedbacks', function($view)
        {
            $feedback = new Feedback();
            $feedbackRepo = new FeedbackRepository($feedback);
            $feedbackService = new FeedbackService($feedbackRepo);
            $feedbacks = $feedbackService->toAdminPanel();

            $view->with(['feedbacks' => $feedbacks]);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
