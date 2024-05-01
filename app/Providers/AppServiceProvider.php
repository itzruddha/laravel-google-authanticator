<?php

namespace App\Providers;

use App\Events\AdminCreateMail;
use App\Listeners\SenduserMail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use function Illuminate\Events\queueable;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        // Event::listen(
        //     AdminCreateMail::class,
        //     SenduserMail::class,
        // );

        Event::listen(function (AdminCreateMail $event) {
            // ...
        });
    }
}
