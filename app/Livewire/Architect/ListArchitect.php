<?php

namespace App\Livewire\Architect;

use App\Models\Architect;
use Filament\Tables\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class ListArchitect extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Architect::query())
            ->heading('Architects')
            ->striped()
            ->description('List of all architects.')
            ->headerActions([
                Action::make('create')
                    ->label('Create Architect')
                    ->icon('heroicon-o-plus')
                    ->url(route('architects.create'))
                    ->icon('heroicon-o-plus')
                    ->button()
            ])
            ->columns([
                Tables\Columns\TextColumn::make('user.full_name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.phone')
                    ->label('Phone')
                    ->sortable(),
                Tables\Columns\TextColumn::make('experience')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('qualifications')
                    ->limit(30)
                    ->html()
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
                Tables\Filters\SelectFilter::make('Experience'),
            ])
            ->actions([
                //
            ])
            ->emptyStateHeading('No architect yet.')
            ->emptyStateDescription('Once you add an architect, you can view them here.')
            ->emptyStateIcon('heroicon-o-users')
            ->emptyStateActions([
                Action::make('Create New Architect')
                    ->icon('heroicon-o-plus')
                    ->url(route('architects.create'))
                    ->button(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.architect.list-architect');
    }
}
