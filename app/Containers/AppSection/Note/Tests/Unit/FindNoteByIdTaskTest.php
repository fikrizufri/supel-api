<?php

namespace App\Containers\AppSection\Note\Tests\Unit;

use App\Containers\AppSection\Note\Events\NoteFoundByIdEvent;
use App\Containers\AppSection\Note\Models\Note;
use App\Containers\AppSection\Note\Tasks\FindNoteByIdTask;
use App\Containers\AppSection\Note\Tests\TestCase;
use App\Ship\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Event;

/**
 * Class FindNoteByIdTaskTest.
 *
 * @group note
 * @group unit
 */
class FindNoteByIdTaskTest extends TestCase
{
    public function testFindNoteById(): void
    {
        Event::fake();
        $note = Note::factory()->create();

        $foundNote = app(FindNoteByIdTask::class)->run($note->id);

        $this->assertEquals($note->id, $foundNote->id);
        Event::assertDispatched(NoteFoundByIdEvent::class);
    }

    public function testFindNoteWithInvalidId(): void
    {
        $this->expectException(NotFoundException::class);

        $noneExistingId = 777777;

        app(FindNoteByIdTask::class)->run($noneExistingId);
    }
}
