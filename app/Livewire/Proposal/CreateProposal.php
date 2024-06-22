<?php

namespace App\Livewire\Proposal;

use Filament\Forms;
use App\Models\Project;
use Livewire\Component;
use App\Models\Proposal;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateProposal extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public Project $project;

    public function mount(Project $project): void
    {
        $this->project = $project;
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->columns(5)
                    ->schema([
                        Forms\Components\Section::make()
                            ->columns(3)
                            ->schema([
                                Forms\Components\RichEditor::make('description')
                                    ->required()
                                    ->placeholder('Type how you will handle the project here ')
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('price')
                                    ->required()
                                    ->numeric()
                                    ->placeholder('100')
                                    ->prefix('GHC')
                                    ->suffix('.00'),
                                Forms\Components\DateTimePicker::make('deadline')
                                    ->native(false)
                                    ->time(false)
                                    ->placeholder(now())
                                    ->required(),
                            ])
                            ->columns(2)
                    ])

            ])
            ->statePath('data')
            ->model(Proposal::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $data['project_id'] = $this->project->id;
        $data['title'] = $this->project->title;

        $record = Proposal::saveProposal($data);

        $this->form->model($record)->saveRelationships();

        redirect()->route('projects.index');
    }

    public function render(): View
    {
        $this->authorize('create', Proposal::class);
        return view('livewire.proposal.create-proposal');
    }
}
