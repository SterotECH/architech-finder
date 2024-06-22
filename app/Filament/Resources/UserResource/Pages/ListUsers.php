<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Actions;
use App\Enums\UserRole;
use Filament\Resources\Components\Tab;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make('architect')
                ->icon('heroicon-s-users')
                ->label('Add Architect')
                ->button(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'architect' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('role', UserRole::ARCHITECT)),
            'client' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('role', UserRole::CLIENT)),
        ];
    }
}
