<?php

namespace App\Livewire\Project;

use App\Models\Project;
use Livewire\Component;
use App\Models\Proposal;
use Filament\Actions\DeleteAction;
use Filament\Infolists\Infolist;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry\TextEntrySize;
use Filament\Infolists\Concerns\InteractsWithInfolists;

class ShowProject extends Component implements HasForms, HasInfolists
{
    use InteractsWithForms;
    use InteractsWithInfolists;


    public Project $project;
    public $proposals;


    public function projectInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Project')
                    ->columns(2)
                    ->schema([
                        ImageEntry::make('client.user.profile_photo_url')
                            ->columnSpanFull()
                            ->hiddenLabel()
                            ->circular()
                            ->alignCenter(),
                        TextEntry::make('client.user.full_name')
                            ->label('Client'),
                        TextEntry::make('description')
                            ->html()
                            ->label('Description')
                            ->columnSpanFull()
                            ->default($this->project->description),
                        TextEntry::make('status')
                            ->badge()
                            ->size(TextEntrySize::Large)
                            ->color(function ($state): string {
                                return match ($state) {
                                    'draft' => 'warning',
                                    'published' => 'success',
                                    'archived' => 'danger',
                                };
                            })
                            ->icon(function ($state): string {
                                return match ($state) {
                                    'draft' => 'heroicon-s-exclamation-circle',
                                    'published' => 'heroicon-s-check-circle',
                                    'archived' => 'heroicon-s-x-circle',
                                };
                            })
                            ->label('Status'),
                        TextEntry::make('type')
                            ->badge()
                            ->color(function ($state): string {
                                return match ($state) {
                                    'residential' => 'primary',
                                    'commercial' => 'secondary',
                                    'industrial' => 'danger',
                                };
                            })
                            ->icon(function ($state): string {
                                return match ($state) {
                                    'residential' => 'heroicon-s-home',
                                    'commercial' => 'heroicon-s-building-storefront',
                                    'industrial' => 'heroicon-s-building-office-2',
                                };
                            })
                            ->label('Type'),

                        Actions::make([
                            Action::make('View Proposals')
                                ->icon('heroicon-s-paper-clip')
                                ->visible(function () {
                                    return auth()->user()->isClient();
                                })
                                ->url(function (Project $record) {
                                    return route('projects.proposals.index', $record);
                                }),
                        ])->columnSpanFull(),
                    ])
            ])
            ->columns(2)
            ->record($this->project);
    }
    public function render()
    {
        return view('livewire.project.show-project', [
            'form' => $this->form,
        ]);
    }
}
