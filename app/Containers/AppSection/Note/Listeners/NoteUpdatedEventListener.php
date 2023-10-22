<?php

namespace App\Containers\AppSection\Note\Listeners;

use App\Containers\AppSection\Note\Events\NoteUpdatedEvent;
use App\Ship\Parents\Listeners\Listener as ParentListener;
use Illuminate\Contracts\Queue\ShouldQueue;

class NoteUpdatedEventListener extends ParentListener implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(NoteUpdatedEvent $event): void
    {
        //
    }
}
