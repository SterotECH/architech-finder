<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Notifications\Livewire\DatabaseNotifications;
use Filament\Notifications\Notification;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
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
        Notification::configureUsing(function (Notification $notification): void {
            $notification->view('notifications.notification');
        });
        DatabaseNotifications::trigger('filament.notifications.database-notifications-trigger');

        FilamentColor::register([
            'danger' => Color::Red,
            'slate' => Color::Zinc,
            'info' => Color::Blue,
            'primary' => Color::Indigo,
            'success' => Color::Green,
            'warning' => Color::Amber,
            'secondary' => Color::Purple
        ]);
    }
}
