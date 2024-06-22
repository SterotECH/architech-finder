<?php

namespace App\Livewire\Forms;

use App\Models\Project;
use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Support\Facades\Gate;

class ProjectForm extends Form
{
    #[Validate('required|string|min:5|max:255')]
    public $title = '';

    #[Validate('required|min:100|string')]
    public $description = '';

    #[Validate('required|string|min:5|max:255')]
    public $type = 'residential';

    public function createProject()
    {
        if (Gate::denies('create', Project::class)) {
            abort(403, 'Unauthorized action.');
        }

        Project::saveProject($this->all());
    }
}
