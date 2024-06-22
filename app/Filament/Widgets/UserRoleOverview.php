<?php

namespace App\Filament\Widgets;

use App\Enums\UserRole;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserRoleOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('All Users', User::count()),
            Stat::make('Clients', User::query()->where('role', UserRole::CLIENT)->count()),
            Stat::make('Architects', User::query()->where('role', UserRole::ARCHITECT)->count()),
        ];
    }
}
