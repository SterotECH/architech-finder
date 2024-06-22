<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasDescription;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ProjectType: string implements HasLabel, HasColor, HasIcon, HasDescription
{
    case Residential = 'residential';
    case Commercial = 'commercial';
    case Industrial = 'industrial';

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getColor(): string | array | null
    {
        return match ($this) {
            self::Residential => 'primary',
            self::Commercial => 'secondary',
            self::Industrial => 'danger',
        };
    }


    public function getIcon(): ?string
    {
        return match ($this) {
            self::Residential => 'heroicon-o-home',
            self::Commercial => 'heroicon-o-building',
            self::Industrial => 'heroicon-o-factory',
        };
    }

    public function getDescription(): ?string
    {
        return match ($this) {
            self::Residential => 'This is project with residential type',
            self::Commercial => 'This is a commercial project',
            self::Industrial => 'This is an industry project',
        };
    }

    public function getOptions(): array
    {
        return [
            self::Residential,
            self::Commercial,
            self::Industrial,
        ];
    }
}
