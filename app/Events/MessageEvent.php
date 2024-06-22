<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Message $message;

    /**
     * Create a new event instance.
     */
    public function __construct(int $sender_id, int $recipient_id, int $project_id, string $content, $sender_name, $recipient_name)
    {
        $message = Message::create([
            'sender_id' => $sender_id,
            'recipient_id' => $recipient_id,
            'project_id' => $project_id,
            'content' => $content,
        ]);

        $message['sender_name'] = $sender_name;
        $message['recipient_name'] = $recipient_name;

        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.' . $this->message->project_id),
        ];
    }

    public function broadcastWith()
    {
        return ['message' => $this->message->toArray()];
    }
}
