<?php

namespace App\Containers\AppSection\Note\Tests\Unit;

use App\Containers\AppSection\Note\Events\NoteCreatedEvent;
use App\Containers\AppSection\Note\Tasks\CreateNoteTask;
use App\Containers\AppSection\Note\Tests\TestCase;
use App\Ship\Exceptions\CreateResourceFailedException;
use Illuminate\Support\Facades\Event;

/**
 * Class CreateNoteTaskTest.
 *
 * @group note
 * @group unit
 */
class CreateNoteTaskTest extends TestCase
{
    public function testCreateNote(): void
    {
        Event::fake();
        $data = [];

        $note = app(CreateNoteTask::class)->run($data);

        $this->assertModelExists($note);
        Event::assertDispatched(NoteCreatedEvent::class);
    }

    // TODO TEST
//    public function testCreateNoteWithInvalidData(): void
//    {
//        $this->expectException(CreateResourceFailedException::class);
//
//        $data = [
//            // put some invalid data here
//            // 'invalid' => 'data',
//        ];
//
//        app(CreateNoteTask::class)->run($data);
//    }
}
