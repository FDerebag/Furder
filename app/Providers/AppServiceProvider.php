<?php

namespace App\Providers;

use App\Models\ContactMessage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // Share unread count with admin layout
        View::composer('admin.layout', function ($view) {
            if (class_exists(ContactMessage::class)) {
                $view->with('unreadCount', ContactMessage::unread()->count());
            } else {
                $view->with('unreadCount', 0);
            }
        });
    }
}
