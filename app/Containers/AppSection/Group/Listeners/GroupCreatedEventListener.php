<?php

namespace App\Containers\AppSection\Group\Listeners;

use App\Containers\AppSection\Group\Events\GroupCreatedEvent;
use App\Ship\Parents\Listeners\Listener as ParentListener;
use Illuminate\Contracts\Queue\ShouldQueue;

class GroupCreatedEventListener extends ParentListener implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(GroupCreatedEvent $event): void
    {
        //
    }
}
