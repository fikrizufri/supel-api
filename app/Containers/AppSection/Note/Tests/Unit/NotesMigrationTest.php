<?php

namespace App\Containers\AppSection\Note\Tests\Unit;

use App\Containers\AppSection\Note\Tests\TestCase;
use Illuminate\Support\Facades\Schema;

/**
 * Class NotesMigrationTest.
 *
 * @group note
 * @group unit
 */
class NotesMigrationTest extends TestCase
{
    public function test_notes_table_has_expected_columns(): void
    {
        $columns = [
            'id',
            // add your migration columns
            'created_at',
            'updated_at',
        ];

        foreach ($columns as $column) {
            $this->assertTrue(Schema::hasColumn('notes', $column));
        }
    }
}
