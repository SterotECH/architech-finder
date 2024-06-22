<?php

namespace App\Livewire\Architect;

use Filament\Forms;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\Architect;
use Illuminate\Support\HtmlString;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Blade;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use App\Http\Controllers\ArchitectController;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateArchitect extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $step = 1;
    public $maxStep = 3;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make()
                    ->persistStepInQueryString()
                    ->nextAction(
                        fn (Action $action) => $action->label('Next step'),
                    )
                    ->previousAction(
                        fn (Action $action) => $action->label('Previous step'),
                    )
                    ->schema([
                        Forms\Components\Wizard\Step::make('User Information')
                            ->completedIcon('heroicon-s-users')
                            ->icon('heroicon-m-users')
                            ->description('Fill in the architect details.')
                            ->schema([
                                Forms\Components\TextInput::make('first_name')
                                    ->required()
                                    ->label('First Name'),
                                Forms\Components\TextInput::make('last_name')
                                    ->required()
                                    ->label('Last Name'),
                                Forms\Components\TextInput::make('other_name')
                                    ->label('Other Name'),
                                Forms\Components\TextInput::make('phone')
                                    ->mask('+233 999 999 999')
                                    ->placeholder('+233 500 000 000')
                                    ->required()
                                    ->label('Phone'),
                                Forms\Components\Textarea::make('address')
                                    ->columnSpanFull()
                                    ->label('Address'),
                                Forms\Components\TextInput::make('email')
                                    ->required()
                                    ->label('Email')
                                    ->email(),
                                Forms\Components\TextInput::make('password')
                                    ->required()
                                    ->revealable()
                                    ->label('Password')
                                    ->password(),
                            ])
                            ->columns(2),
                        Forms\Components\Wizard\Step::make('Architect Details')
                            ->icon('heroicon-m-shopping-bag')
                            ->schema([
                                Forms\Components\TextInput::make('experience')
                                    ->required()
                                    ->label('Experience')
                                    ->columnSpanFull()
                                    ->numeric(),
                                Forms\Components\RichEditor::make('bio')
                                    ->required()
                                    ->disableToolbarButtons([
                                        'blockquote',
                                        'strike',
                                        'underline',
                                        'codeBlock',
                                    ])
                                    ->label('Bio'),
                                Forms\Components\RichEditor::make('qualifications')
                                    ->required()
                                    ->disableToolbarButtons([
                                        'blockquote',
                                        'strike',
                                        'underline',
                                        'codeBlock',
                                    ])
                                    ->label('Qualifications'),
                            ]),
                    ])->submitAction(new HtmlString(Blade::render(<<<BLADE
                    <x-filament::button
                        wire:click="create(true)"
                        type="submit"
                        size="sm"
                    >
                        Submit
                    </x-filament::button>
                BLADE)))
                    ->columns(2)

            ])
            ->statePath('data')
            ->model(Architect::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $response = ArchitectController::store($data);

        if ($response) {
            Notification::make()
                ->title('Saved successfully')
                ->body('Architect created successfully!')
                ->icon('heroicon-o-users')
                ->iconColor('success')
                ->send();
            redirect()->route('architects.index');
        } else {
            Notification::make()
                ->title('Saved successfully')
                ->body('Architect created successfully!')
                ->icon('heroicon-o-users')
                ->iconColor('danger')
                ->send();
            session()->flash('error', 'There was an error creating the architect.');
        }
    }

    public function render(): View
    {
        return view('livewire.architect.create-architect');
    }
}
