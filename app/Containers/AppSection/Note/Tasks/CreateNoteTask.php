<?php

namespace App\Containers\AppSection\Note\Tasks;

use App\Containers\AppSection\Note\Data\Repositories\NoteRepository;
use App\Containers\AppSection\Note\Events\NoteCreatedEvent;
use App\Containers\AppSection\Note\Models\Note;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class CreateNoteTask extends ParentTask
{
    public function __construct(
        protected NoteRepository $repository
    ) {
    }

    /**
     * @throws CreateResourceFailedException
     */
    public function run(array $data): Note
    {
        try {
            $note = $this->repository->create($data);
            NoteCreatedEvent::dispatch($note);

            return $note;
        } catch (Exception) {
            throw new CreateResourceFailedException();
        }
    }
}
