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
      self::RESIDENTIAL => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-home"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
      self::COMMERCIAL => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-building"><rect width="16" height="20" x="4" y="2" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/></svg>',
      self::INDUSTRIAL => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-factory"><path d="M2 20a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8l-7 5V8l-7 5V4a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M17 18h1"/><path d="M12 18h1"/><path d="M7 18h1"/></svg>',
      self::INSTITUTIONAL => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-school"><path d="M14 22v-4a2 2 0 1 0-4 0v4"/><path d="m18 10 4 2v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8l4-2"/><path d="M18 5v17"/><path d="m4 6 8-4 8 4"/><path d="M6 5v17"/><circle cx="12" cy="9" r="2"/></svg>',
      self::LANDSCAPE => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-proportions"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="M12 9v11"/><path d="M2 9h13a2 2 0 0 1 2 2v9"/></svg>',
      self::INTERIOR => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shower-head"><path d="m4 4 2.5 2.5"/><path d="M13.5 6.5a4.95 4.95 0 0 0-7 7"/><path d="M15 5 5 15"/><path d="M14 17v.01"/><path d="M10 16v.01"/><path d="M13 13v.01"/><path d="M16 10v.01"/><path d="M11 20v.01"/><path d="M17 14v.01"/><path d="M20 11v.01"/></svg>',
      self::RURAL => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-utility-pole"><path d="M12 2v20"/><path d="M2 5h20"/><path d="M3 3v2"/><path d="M7 3v2"/><path d="M17 3v2"/><path d="M21 3v2"/><path d="m19 5-7 7-7-7"/></svg>',
      self::URBAN => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-utility-pole"><path d="M12 2v20"/><path d="M2 5h20"/><path d="M3 3v2"/><path d="M7 3v2"/><path d="M17 3v2"/><path d="M21 3v2"/><path d="m19 5-7 7-7-7"/></svg>',
      self::OTHER => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pickaxe"><path d="M14.531 12.469 6.619 20.38a1 1 0 1 1-3-3l7.912-7.912"/><path d="M15.686 4.314A12.5 12.5 0 0 0 5.461 2.958 1 1 0 0 0 5.58 4.71a22 22 0 0 1 6.318 3.393"/><path d="M17.7 3.7a1 1 0 0 0-1.4 0l-4.6 4.6a1 1 0 0 0 0 1.4l2.6 2.6a1 1 0 0 0 1.4 0l4.6-4.6a1 1 0 0 0 0-1.4z"/><path d="M19.686 8.314a12.501 12.501 0 0 1 1.356 10.225 1 1 0 0 1-1.751-.119 22 22 0 0 0-3.393-6.319"/></svg>',
    };
  }

  function getColor (): string
  {
    return match ($this) {
      self::RESIDENTIAL => 'text-blue-500 ',
      self::COMMERCIAL => 'text-amber-500',
      self::INDUSTRIAL => 'text-green-500',
      self::INSTITUTIONAL => 'text-sky-500',
      self::LANDSCAPE => 'text-red-500',
      self::INTERIOR => 'text-emerald-500',
      self::RURAL => 'text-teal-500',
      self::URBAN => 'text-light',
      self::OTHER => 'text-dark',
    };
  }
}
