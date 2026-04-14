<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use App\Models\Restaurant;

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
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }

        View::composer('*', function ($view) {
        $owner = Auth::guard('restaurant')->user();

        if ($owner) {
            $unreadCount = Notification::where('recipient_id', $owner->id)
                ->where('recipient_type', Restaurant::class)
                ->where('is_completed', false)
                ->count();
        } else {
            $unreadCount = 0;
        }

        $view->with('unreadCount', $unreadCount);
    });
    }
}
