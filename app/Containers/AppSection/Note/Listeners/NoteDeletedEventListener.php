<?php

namespace App\Containers\AppSection\Note\Listeners;

use App\Containers\AppSection\Note\Events\NoteDeletedEvent;
use App\Ship\Parents\Listeners\Listener as ParentListener;
use Illuminate\Contracts\Queue\ShouldQueue;

class NoteDeletedEventListener extends ParentListener implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(NoteDeletedEvent $event): void
    {
        //
    }
}
