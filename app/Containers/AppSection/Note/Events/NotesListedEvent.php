<?php

namespace App\Containers\AppSection\Note\Events;

use App\Containers\AppSection\Note\Models\Note;
use App\Ship\Parents\Events\Event as ParentEvent;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;

class NotesListedEvent extends ParentEvent
{
    public function __construct(
        public mixed $note
    ) {
    }

    public function broadcastOn(): Channel|array
    {
        return new PrivateChannel('channel-name');
    }
}
