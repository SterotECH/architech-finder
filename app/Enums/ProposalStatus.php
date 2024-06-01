<?php

namespace App\Enums;

enum ProposalStatus: string
{
  case PENDING = 'pending';
  case APPROVED = 'approved';
  case REJECTED = 'rejected';

  public function getLabel(): string
  {
    return match ($this) {
      self::PENDING => 'Pending',
      self::APPROVED => 'Approved',
      self::REJECTED => 'Rejected',
    };
  }

  public function getIcon(): string
  {
    return match ($this) {
      self::PENDING => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-loader"><path d="M12 2v4"/><path d="m16.2 7.8 2.9-2.9"/><path d="M18 12h4"/><path d="m16.2 16.2 2.9 2.9"/><path d="M12 18v4"/><path d="m4.9 19.1 2.9-2.9"/><path d="M2 12h4"/><path d="m4.9 4.9 2.9 2.9"/></svg>',
      self::APPROVED => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check"><path d="M20 6 9 17l-5-5"/></svg>',
      self::REJECTED => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>',
    };
  }

  public function getTextColor(): string
  {
    return match ($this) {
      self::PENDING => 'text-yellow-500',
      self::APPROVED => 'text-green-500',
      self::REJECTED => 'text-red-500',
    };
  }

  public function getBgColor(): string
  {
    return match ($this) {
      self::PENDING => 'bg-gray-100',
      self::APPROVED => 'bg-green-100',
      self::REJECTED => 'bg-red-100',
    };
  }

  public function getTextBG(): string
  {
    return match ($this) {
      self::PENDING => 'bg-yellow-100',
      self::APPROVED => 'bg-green-100',
      self::REJECTED => 'bg-red-100',
    };
  }
}
