<?php

namespace App\Providers;

use App\Activity;
use App\User;
use App\Team;
use App\Feedback;
use App\Helpers\AvatarsHelper;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        view()->composer('partials.dashboard_feedbacks', function ($view) {

            $feedbacks = Feedback::where('status', 'unread')->with(array
                ('user' => function ($query) {
                        $query->select('id', 'first_name', 'last_name', 'email', 'avatar');
                    })
            )->get();

            foreach ($feedbacks as $feedback) {
                $feedback->user->avatar = AvatarsHelper::fullPathToAvatarWeb($feedback->user->avatar);
            }

            $view->with(['feedbacks' => $feedbacks]);
        });

        view()->composer('partials.report_filter', function ($view) {

            $teams = Team::all();
            $athlets = User::all();
            $activities = Activity::all();

            $view->with(['teams' => $teams, 'athlets' => $athlets, 'activities' => $activities]);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
