<?php

namespace App\Livewire\Message;

use App\Models\Project;
use Livewire\Component;

class ListMessage extends Component
{
    public $projects;

    public function mount(Project $projects)
    {
        $this->projects = $projects;
    }
    public function render()
    {
        return view('livewire.message.list-message');
    }
}
