<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasLabel, HasColor, HasIcon, HasDescription
{
    const CLIENT = 'client';
    const ADMIN = 'admin';
    const ARCHITECT = 'architect';

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::CLIENT => 'primary',
            self::ARCHITECT => 'secondary',
            self::ADMIN => 'danger',
        };
    }


    public function getIcon(): ?string
    {
        return match ($this) {
            self::CLIENT => 'heroicon-o-home',
            self::ARCHITECT => 'heroicon-o-building',
            self::ADMIN => 'heroicon-o-factory',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::CLIENT => 'This is project with residential type',
            self::ARCHITECT => 'This is a commercial project',
            self::ADMIN => 'This is an industry project',
        };
    }

    public function getOptions(): array
    {
        return [
            self::CLIENT,
            self::ARCHITECT,
            self::ADMIN,
        ];
    }
}
