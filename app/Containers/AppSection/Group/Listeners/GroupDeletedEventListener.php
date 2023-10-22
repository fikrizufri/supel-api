<?php

namespace App\Containers\AppSection\Group\Listeners;

use App\Containers\AppSection\Group\Events\GroupDeletedEvent;
use App\Ship\Parents\Listeners\Listener as ParentListener;
use Illuminate\Contracts\Queue\ShouldQueue;

class GroupDeletedEventListener extends ParentListener implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(GroupDeletedEvent $event): void
    {
        //
    }
}
