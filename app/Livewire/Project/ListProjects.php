<?php

namespace App\Livewire\Project;

use Filament\Forms;
use Filament\Tables;
use App\Models\Project;
use Livewire\Component;
use App\Enums\ProjectType;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListProjects extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Project::visibleTo(auth()->user()))
            ->description('Manage your projects here.')
            ->heading('Projects')
            ->striped()
            ->reorderable()
            ->poll()
            ->headerActions([
                Tables\Actions\Action::make('create')
                    ->url(route('projects.create'))
                    ->icon('heroicon-o-plus-circle')
                    ->label('Create Project')
                    ->visible(fn () => auth()->user()->isClient())
                    ->button(),
            ])
            ->columns([
                Tables\Columns\TextColumn::make('client.user.full_name')
                    ->label('Client')
                    ->visible(fn () => auth()->user()->isArchitect())
                    ->searchable(),
                Tables\Columns\TextColumn::make('architect.user.full_name')
                    ->visible(fn (Project $project) => auth()->user()->isClient() && $project->architect_id !== null)
                    ->label('Architect')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->description(fn (Project $record): string => $record->slug)
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->html()
                    ->limit(50),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
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
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->sortable()
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
                    ->badge(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('archived_at')
                    ->toggleable(isToggledHiddenByDefault: true)
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
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ])
                    ->native(false),
                Tables\Filters\SelectFilter::make('type')
                    ->options(ProjectType::class)
                    ->native(false),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->native(false)
                            ->placeholder(now())
                            ->time(false),
                        Forms\Components\DatePicker::make('created_until')
                            ->native(false)
                            ->placeholder(now())
                            ->time(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
                Tables\Filters\TernaryFilter::make('trashed')
                    ->placeholder('Without trashed records')
                    ->trueLabel('With trashed records')
                    ->falseLabel('Only trashed records')
                    ->queries(
                        true: fn (Builder $query) => $query->withTrashed(),
                        false: fn (Builder $query) => $query->onlyTrashed(),
                        blank: fn (Builder $query) => $query->withoutTrashed(),
                    )
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->url(function (Project $record) {
                        return route('projects.edit', $record);
                    })
                    ->visible(fn () => auth()->user()->isClient())
                    ->label('Edit')
                    ->color('warning')
                    ->button()
                    ->icon('heroicon-o-pencil-square'),
                Tables\Actions\Action::make('view')
                    ->url(function (Project $record) {
                        return route('projects.show', $record);
                    })
                    ->label('View')
                    ->button()
                    ->icon('heroicon-o-eye'),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => auth()->user()->isClient() || auth()->user()->isAdmin())
                    ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    DeleteBulkAction::make()
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.project.list-projects');
    }
}
