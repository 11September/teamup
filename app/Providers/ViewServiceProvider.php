<?php

namespace App\Providers;

use App\Feedback;
use App\Helpers\AvatarsHelper;
use Illuminate\Support\Facades\Config;
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
                ('user'=>function($query){
                        $query->select('id', 'first_name', 'last_name', 'email', 'avatar');
                    })
            )->get();

            foreach ($feedbacks as $feedback) {
                $feedback->user->avatar = AvatarsHelper::fullPathToAvatarWeb($feedback->user->avatar);
            }

            $view->with(['feedbacks' => $feedbacks]);
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
