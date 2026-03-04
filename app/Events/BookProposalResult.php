<?php

namespace App\Events;

use App\Enums\BookStatus;
use App\Enums\NotificationType;
use App\Models\Book;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookProposalResult implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public Book $book, public BookStatus $bookStatus)
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
            new PrivateChannel('users.' . $this->book->submitted_by)
        ];
    }

    public function broadcastWith(): array {

        $type = $this->bookStatus->value === BookStatus::Approved->value ?
            NotificationType::Success : NotificationType::Information;

        return [
            'type' => $type,
            'title' => 'Your book proposal for ' . $this->book->title .  ' was ' . $this->bookStatus->value,
            'id' => uuid_create()
        ];
    }
}

