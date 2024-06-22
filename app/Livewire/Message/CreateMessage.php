<?php

namespace App\Livewire\Message;

use App\Models\Message;
use App\Models\Project;
use Livewire\Component;
use App\Events\MessageEvent;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class CreateMessage extends Component
{
    public $messages = [];
    public $message;
    public $recipient_id;
    public $project;

    protected $listeners = ['messageReceived' => 'loadMessages'];

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        /** @var \App\Models\Message */
        $messages = Message::where('project_id', $this->project->id)
            ->orderBy('created_at', 'asc')
            ->get();

        foreach ($messages as $message) {
            $this->messages[] = [
                'sender_id' => $message->sender_id,
                'project_id' => $message->project_id,
                'recipient_id' => $message->recipient_id,
                'content' => $message->content,
                'sender_name' => $message->sender->full_name,
                'recipient_name' => $message->recipient->full_name,
                'status' => $message->status,
                'created_at' => $message->created_at,
                'read_at' => $message->read_at,
            ];
        }

        $this->markMessagesAsRead();
    }

    public function markMessagesAsRead()
    {
        Message::where('project_id', $this->project->id)
            ->where('recipient_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now(), 'status' => 'read']);
    }

    public function sendMessage()
    {
        $project = $this->project;
        $sender_id = Auth::user()->id;
        $recipient_id = $project->client->user_id === $sender_id
            ? $project->architect->user_id : $project->client->user_id;
        $sender_name = Auth()->user()->full_name;
        $recipient_name = $project->client->user_id === $sender_id
            ? $project->architect->user->full_name : $project->client->user->full_name;

        MessageEvent::dispatch(
            $sender_id,
            $recipient_id,
            $project->id,
            $this->message,
            $sender_name,
            $recipient_name
        );

        $this->message = '';
    }

    #[On("echo-private:chat.{project.id},MessageEvent")]
    public function onMessageSent($event)
    {
        $this->messages[] = $event['message'];
    }

    public function render()
    {
        return view('livewire.message.create-message');
    }
}
