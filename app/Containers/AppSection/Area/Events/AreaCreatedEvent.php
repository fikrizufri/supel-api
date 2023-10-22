<?php

namespace App\Containers\AppSection\Area\Events;

use App\Containers\AppSection\Area\Models\Area;
use App\Ship\Parents\Events\Event as ParentEvent;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;

class AreaCreatedEvent extends ParentEvent
{
    public function __construct(
        public Area $area
    ) {
    }

    public function broadcastOn(): Channel|array
    {
        return new PrivateChannel('channel-name');
    }
}
