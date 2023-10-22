<?php

namespace App\Containers\AppSection\Note\Tests\Unit;

use App\Containers\AppSection\Note\Events\NoteDeletedEvent;
use App\Containers\AppSection\Note\Models\Note;
use App\Containers\AppSection\Note\Tasks\DeleteNoteTask;
use App\Containers\AppSection\Note\Tests\TestCase;
use App\Ship\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Event;

/**
 * Class DeleteNoteTaskTest.
 *
 * @group note
 * @group unit
 */
class DeleteNoteTaskTest extends TestCase
{
    public function testDeleteNote(): void
    {
        Event::fake();
        $note = Note::factory()->create();

        $result = app(DeleteNoteTask::class)->run($note->id);

        $this->assertEquals(1, $result);
        Event::assertDispatched(NoteDeletedEvent::class);
    }

    public function testDeleteNoteWithInvalidId(): void
    {
        $this->expectException(NotFoundException::class);

        $noneExistingId = 777777;

        app(DeleteNoteTask::class)->run($noneExistingId);
    }
}
