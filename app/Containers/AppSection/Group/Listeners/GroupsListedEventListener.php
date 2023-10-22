<?php

namespace App\Containers\AppSection\Group\Listeners;

use App\Containers\AppSection\Group\Events\GroupsListedEvent;
use App\Ship\Parents\Listeners\Listener as ParentListener;
use Illuminate\Contracts\Queue\ShouldQueue;

class GroupsListedEventListener extends ParentListener implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(GroupsListedEvent $event): void
    {
        //
    }
}
