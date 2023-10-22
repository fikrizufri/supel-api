<?php

namespace App\Containers\AppSection\Voter\Events;

use App\Containers\AppSection\Voter\Models\Voter;
use App\Ship\Parents\Events\Event as ParentEvent;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;

class VoterFoundByIdEvent extends ParentEvent
{
    public function __construct(
        public Voter $voter
    ) {
    }

    public function broadcastOn(): Channel|array
    {
        return new PrivateChannel('channel-name');
    }
}
