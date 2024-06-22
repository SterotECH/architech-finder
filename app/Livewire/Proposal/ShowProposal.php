<?php

namespace App\Livewire\Proposal;

use App\Models\Project;
use App\Models\Proposal;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Actions\Action;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Livewire\Component;
use Filament\Infolists\Infolist;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Concerns\InteractsWithInfolists;

class ShowProposal extends Component implements HasInfolists, HasForms
{
    use InteractsWithInfolists;
    use InteractsWithForms;

    public Project $project;
    public Proposal $proposal;


    public function proposalInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Proposal')
                    ->schema([
                        TextEntry::make('title')
                            ->size('lg'),
                        TextEntry::make('status')
                            ->badge()
                            ->size('lg'),
                        TextEntry::make('price')
                            ->money('GHS', locale: 'en_GH'),
                        TextEntry::make('deadline')
                            ->date(),
                        TextEntry::make('description')
                            ->columnSpanFull()
                            ->html(),
                        Actions::make([
                            Action::make('Accept')
                                ->action(function (Proposal $record) {
                                    $project = $record->project;

                                    Proposal::where('project_id', $project->id)
                                        ->where('id', '!=', $record->id)
                                        ->update(['status' => 'rejected']);

                                    $record->update(['status' => 'approved']);

                                    $project->update([
                                        'status' => 'published',
                                        'architect_id' => $record->architect_id,
                                    ]);
                                    session()->flash('success', 'Proposal accepted successfully.');
                                })
                                ->color('secondary')
                                ->button()
                                ->hidden(fn (Proposal $record) => $record->status === 'approved' || Proposal::where('project_id', $record->project_id)->where('status', 'approved')->exists())
                        ])->alignCenter()
                            ->columnSpanFull()
                    ])
                    ->columns(2)
            ])
            ->record($this->proposal)
            ->columns(2);
    }
    public function render()
    {
        return view('livewire.proposal.show-proposal');
    }
}
