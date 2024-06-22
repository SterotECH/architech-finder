<?php

namespace App\Enums;

enum ProposalStatus: string
{
    case Pending = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';

    public function getLabel(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return match ($this) {
            ProposalStatus::Pending => 'warning',
            ProposalStatus::Approved => 'success',
            ProposalStatus::Rejected => 'danger',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            ProposalStatus::Pending => 'heroicon-o-clock',
            ProposalStatus::Approved => 'heroicon-o-check',
            ProposalStatus::Rejected => 'heroicon-o-x-mark',
        };
    }
}
