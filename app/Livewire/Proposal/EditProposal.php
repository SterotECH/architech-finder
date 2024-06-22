<?php

namespace App\Livewire\Proposal;

use Filament\Forms;
use Livewire\Component;
use App\Models\Proposal;
use Filament\Forms\Form;
use Filament\Support\RawJs;
use App\Enums\ProposalStatus;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class EditProposal extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Proposal $record;

    public function mount($project_slug, $proposal): void
    {
        $this->record = $proposal;

        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('project_id')
                    ->relationship('project', 'title')
                    ->disabled()
                    ->native()
                    ->required(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->mask(RawJs::make('$money($input)'))
                    ->stripCharacters(',')
                    ->prefix('GHC'),
                Forms\Components\Select::make('status')
                    ->native(false)
                    ->disabled()
                    ->options(ProposalStatus::class),
                Forms\Components\DateTimePicker::make('deadline')
                    ->native(false)
                    ->time(false)
                    ->required(),
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
            ])
            ->columns(2)
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);
    }

    public function render(): View
    {
        return view('livewire.proposal.edit-proposal');
    }
}
