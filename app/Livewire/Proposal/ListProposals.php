<?php

namespace App\Livewire\Proposal;

use App\Models\Proposal;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class ListProposals extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public $proposal;

    public $project_id = '';

    public function mount($proposals, $project): void
    {
        $this->project_id  = $project->id;
        $this->proposal    = $proposals;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Proposal::visibleProposal($this->project_id))
            ->striped()
            ->headerActions([
                Tables\Actions\Action::make('add')
                    ->url(fn (): string => route('projects.proposals.create', $this->project_id))
                    ->label('Add Proposal')
                    ->icon('heroicon-o-plus')
                    ->color('primary')
                    ->visible(fn (): bool => auth()->user()->can('create', Proposal::class)),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('architect.user.name')
                    ->searchable()
                    ->label('Architect')
                    ->sortable(),
                Tables\Columns\TextColumn::make('project.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('GHS', locale: 'en_GH')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('deadline')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->label('Edit')
                    ->visible(fn (): bool => auth()->user()->isArchitect())
                    ->url(fn (Proposal $record): string => route('projects.proposals.edit', [$record->project, $record]))
                    ->icon('heroicon-o-pencil')
                    ->color('primary'),
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->url(fn (Proposal $record): string => route('projects.proposals.show', [$record->project, $record]))
                    ->icon('heroicon-o-eye')
                    ->color('slate'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.proposal.list-proposals');
    }
}
