<?php

namespace App\Containers\AppSection\Group\Events;

use App\Containers\AppSection\Group\Models\Group;
use App\Ship\Parents\Events\Event as ParentEvent;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;

class GroupFoundByIdEvent extends ParentEvent
{
    public function __construct(
        public Group $group
    ) {
    }

    public function broadcastOn(): Channel|array
    {
        return new PrivateChannel('channel-name');
    }
}
