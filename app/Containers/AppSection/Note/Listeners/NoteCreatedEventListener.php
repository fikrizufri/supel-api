<?php

namespace App\Containers\AppSection\Note\Listeners;

use App\Containers\AppSection\Note\Events\NoteCreatedEvent;
use App\Ship\Parents\Listeners\Listener as ParentListener;
use Illuminate\Contracts\Queue\ShouldQueue;

class NoteCreatedEventListener extends ParentListener implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(NoteCreatedEvent $event): void
    {
        //
    }
}
