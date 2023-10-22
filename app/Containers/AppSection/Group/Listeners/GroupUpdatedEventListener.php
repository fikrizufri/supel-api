<?php

namespace App\Containers\AppSection\Group\Listeners;

use App\Containers\AppSection\Group\Events\GroupUpdatedEvent;
use App\Ship\Parents\Listeners\Listener as ParentListener;
use Illuminate\Contracts\Queue\ShouldQueue;

class GroupUpdatedEventListener extends ParentListener implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(GroupUpdatedEvent $event): void
    {
        //
    }
}
