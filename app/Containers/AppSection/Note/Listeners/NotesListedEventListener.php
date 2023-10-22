<?php

namespace App\Containers\AppSection\Note\Listeners;

use App\Containers\AppSection\Note\Events\NotesListedEvent;
use App\Ship\Parents\Listeners\Listener as ParentListener;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotesListedEventListener extends ParentListener implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(NotesListedEvent $event): void
    {
        //
    }
}
