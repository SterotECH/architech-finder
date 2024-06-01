<?php

namespace App\Enums;

enum ProjectType: string
{
  case RESIDENTIAL = 'residential';
  case COMMERCIAL = 'commercial';
  case INDUSTRIAL = 'industrial';
  case INSTITUTIONAL = 'institutional';
  case LANDSCAPE = 'landscape';
  case INTERIOR = 'interior';
  case RURAL = 'rural';
  case URBAN = 'urban';
  case OTHER = 'other';

  public function getLabel(): string
  {
    return match ($this) {
      self::RESIDENTIAL => 'Residential',
      self::COMMERCIAL => 'Commercial',
      self::INDUSTRIAL => 'Industrial',
      self::INSTITUTIONAL => 'Institutional',
      self::LANDSCAPE => 'Landscape',
      self::INTERIOR => 'Interior',
      self::RURAL => 'Rural',
      self::URBAN => 'Urban',
      self::OTHER => 'Other',
    };
  }

  public function getLabelPlural(): string
  {
    return match ($this) {
      self::RESIDENTIAL => 'Residential',
      self::COMMERCIAL => 'Commercials',
      self::INDUSTRIAL => 'Industrials',
      self::INSTITUTIONAL => 'Institutional',
      self::LANDSCAPE => 'Landscapes',
      self::INTERIOR => 'Interiors',
      self::RURAL => "Rural's",
      self::URBAN => 'Urban',
      self::OTHER => 'Others',
    };
  }

  function getIcon(): string
  {
    return match ($this) {
      self::RESIDENTIAL => 'home',
      self::COMMERCIAL => 'building',
      self::INDUSTRIAL => 'industry',
      self::INSTITUTIONAL => 'school',
      self::LANDSCAPE => 'landscape',
      self::INTERIOR => 'interior',
      self::RURAL => 'rural',
      self::URBAN => 'urban',
      self::OTHER => 'other',
    };
  }

  function getColor (): string
  {
    return match ($this) {
      self::RESIDENTIAL => 'bg-primary',
      self::COMMERCIAL => 'bg-secondary',
      self::INDUSTRIAL => 'bg-success',
      self::INSTITUTIONAL => 'bg-info',
      self::LANDSCAPE => 'bg-warning',
      self::INTERIOR => 'bg-danger',
      self::RURAL => 'bg-dark',
      self::URBAN => 'bg-light',
      self::OTHER => 'bg-dark',
    };
  }
}
