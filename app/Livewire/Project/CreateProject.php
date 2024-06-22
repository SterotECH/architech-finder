<?php

namespace App\Livewire\Project;

use App\Models\User;
use App\Models\Project;
use Livewire\Component;
use App\Events\ProjectCreated;
use App\Livewire\Forms\ProjectForm;


class CreateProject extends Component
{
    public ProjectForm $form;

    public function save()
    {
        $this->validate();

        $this->form->createProject();

        $users = User::where('role', 'architect')->get();

        foreach ($users as $user) {
            $user->notify(new ProjectCreated($this->form->title));
        }

        session()->flash('status', 'Project successfully updated.');

        redirect(route('projects.index'));
    }

    public function render()
    {
        $this->authorize('create', Project::class);

        return view('livewire.project.create-project');
    }
}
