<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in progress';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';

    public function getLabel() : string
    {
      return match($this) {
        self::PENDING => 'Pending',
        self::IN_PROGRESS => 'In Progress',
        self::COMPLETED => 'Completed',
        self::CANCELLED => 'Cancelled',
      };
    }

    public function getColor() : string
    {
      return match($this) {
        self::PENDING => 'bg-yellow-100',
        self::IN_PROGRESS => 'bg-teal-100',
        self::COMPLETED => 'bg-green-100',
        self::CANCELLED => 'bg-red-100',
      };
    }

    public function getTextColor() : string
    {
      return match($this) {
        self::PENDING => 'text-yellow-800',
        self::IN_PROGRESS => 'text-teal-800',
        self::COMPLETED => 'text-green-800',
        self::CANCELLED => 'text-red-800',
      };
    }

    public function getSVG(): string
    {
      return match($this){
        self::PENDING => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-dashed size-2.5"><path d="M10.1 2.182a10 10 0 0 1 3.8 0"/><path d="M13.9 21.818a10 10 0 0 1-3.8 0"/><path d="M17.609 3.721a10 10 0 0 1 2.69 2.7"/><path d="M2.182 13.9a10 10 0 0 1 0-3.8"/><path d="M20.279 17.609a10 10 0 0 1-2.7 2.69"/><path d="M21.818 10.1a10 10 0 0 1 0 3.8"/><path d="M3.721 6.391a10 10 0 0 1 2.7-2.69"/><path d="M6.391 20.279a10 10 0 0 1-2.69-2.7"/></svg>',
        self::IN_PROGRESS => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-loader size-2.5"><path d="M12 2v4"/><path d="m16.2 7.8 2.9-2.9"/><path d="M18 12h4"/><path d="m16.2 16.2 2.9 2.9"/><path d="M12 18v4"/><path d="m4.9 19.1 2.9-2.9"/><path d="M2 12h4"/><path d="m4.9 4.9 2.9 2.9"/></svg>',
        self::COMPLETED => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check-check size-2.5"><path d="M18 6 7 17l-5-5"/><path d="m22 10-7.5 7.5L13 16"/></svg>',
        self::CANCELLED => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-x size-2.5"><circle cx="12" cy="12" r="10"/><path d="m15 9-6 6"/><path d="m9 9 6 6"/></svg>'
      };
    }
}
