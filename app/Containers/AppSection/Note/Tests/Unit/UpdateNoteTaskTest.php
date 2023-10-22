<?php

namespace App\Containers\AppSection\Note\Tests\Unit;

use App\Containers\AppSection\Note\Events\NoteUpdatedEvent;
use App\Containers\AppSection\Note\Models\Note;
use App\Containers\AppSection\Note\Tasks\UpdateNoteTask;
use App\Containers\AppSection\Note\Tests\TestCase;
use App\Ship\Exceptions\NotFoundException;
use Illuminate\Support\Facades\Event;

/**
 * Class UpdateNoteTaskTest.
 *
 * @group note
 * @group unit
 */
class UpdateNoteTaskTest extends TestCase
{
    // TODO TEST
    public function testUpdateNote(): void
    {
        Event::fake();
        $note = Note::factory()->create();
        $data = [
            // add some fillable fields here
            // 'some_field' => 'new_field_data',
        ];

        $updatedNote = app(UpdateNoteTask::class)->run($data, $note->id);

        $this->assertEquals($note->id, $updatedNote->id);
        // assert if fields are updated
        // $this->assertEquals($data['some_field'], $updatedNote->some_field);
        Event::assertDispatched(NoteUpdatedEvent::class);
    }

    public function testUpdateNoteWithInvalidId(): void
    {
        $this->expectException(NotFoundException::class);

        $noneExistingId = 777777;

        app(UpdateNoteTask::class)->run([], $noneExistingId);
    }
}
