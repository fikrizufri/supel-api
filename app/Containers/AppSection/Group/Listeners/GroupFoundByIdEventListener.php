<?php

namespace App\Containers\AppSection\Group\Listeners;

use App\Containers\AppSection\Group\Events\GroupFoundByIdEvent;
use App\Ship\Parents\Listeners\Listener as ParentListener;
use Illuminate\Contracts\Queue\ShouldQueue;

class GroupFoundByIdEventListener extends ParentListener implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(GroupFoundByIdEvent $event): void
    {
        //
    }
}
