<?php

namespace App\Events;

use App\Enums\NotificationType;
use App\Models\Book;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewBookProposal implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Book $book)
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('users.admins.proposals'),
        ];
    }

    public function broadcastWith(): array {
        return [
          'type' => NotificationType::Information,
            'title' => 'A new book proposal has been sent',
            'id' => uuid_create(),
            'action_url' => env('APP_URL') . '/books/' . $this->book->id,
            'action_desc' => 'Review it'
        ];
    }
}
