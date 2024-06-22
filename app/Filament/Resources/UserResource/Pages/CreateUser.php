<?php

namespace App\Filament\Resources\UserResource\Pages;

use Filament\Forms;
use Filament\Actions;
use Filament\Forms\Form;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\UserResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\Actions\Action;

class CreateUser extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = UserResource::class;

    protected function getSteps(): array
    {
        return [
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
                ])->columns(2),
        ];
    }

    protected function handleRecordCreation(array $data): Model
    {
        return static::getModel()::saveArchitect($data);
    }

    protected function getRedirectUrl(): string
    {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('User registered')
            ->body('The user has been created successfully.');
    }
}
