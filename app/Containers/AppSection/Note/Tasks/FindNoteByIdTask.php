<?php

namespace App\Containers\AppSection\Note\Tasks;

use App\Containers\AppSection\Note\Data\Repositories\NoteRepository;
use App\Containers\AppSection\Note\Events\NoteFoundByIdEvent;
use App\Containers\AppSection\Note\Models\Note;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;

class FindNoteByIdTask extends ParentTask
{
    public function __construct(
        protected NoteRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     */
    public function run($id): Note
    {
        try {
            $note = $this->repository->find($id);
            NoteFoundByIdEvent::dispatch($note);

            return $note;
        } catch (Exception) {
            throw new NotFoundException();
        }
    }
}
