<?php

namespace App\Containers\AppSection\Note\Tests\Unit;

use App\Containers\AppSection\Note\Events\NotesListedEvent;
use App\Containers\AppSection\Note\Models\Note;
use App\Containers\AppSection\Note\Tasks\GetAllNotesTask;
use App\Containers\AppSection\Note\Tests\TestCase;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Event;

/**
 * Class GetAllNotesTaskTest.
 *
 * @group note
 * @group unit
 */
class GetAllNotesTaskTest extends TestCase
{
    public function testGetAllNotes(): void
    {
        Event::fake();
        Note::factory()->count(3)->create();

        $foundNotes = app(GetAllNotesTask::class)->run();

        $this->assertCount(3, $foundNotes);
        $this->assertInstanceOf(LengthAwarePaginator::class, $foundNotes);
        Event::assertDispatched(NotesListedEvent::class);
    }
}
