<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Chat;
use App\Message;
use App\User;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        //Service for Chat messages
        view()->composer('layouts.overlay', function($view) {
            $chats = Auth::user()->chats;

            $date = new \DateTime();

            $view->withChats($chats)->withDate($date->getTimestamp());
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
