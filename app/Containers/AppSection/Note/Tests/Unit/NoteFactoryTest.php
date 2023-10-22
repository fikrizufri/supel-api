<?php

namespace App\Containers\AppSection\Note\Tests\Unit;

use App\Containers\AppSection\Note\Models\Note;
use App\Containers\AppSection\Note\Tests\TestCase;

/**
 * Class NoteFactoryTest.
 *
 * @group note
 * @group unit
 */
class NoteFactoryTest extends TestCase
{
    public function testCreateNote(): void
    {
        $note = Note::factory()->make();

        $this->assertInstanceOf(Note::class, $note);
    }
}
