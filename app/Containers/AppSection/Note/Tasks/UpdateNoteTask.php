<?php

namespace App\Containers\AppSection\Note\Tasks;

use App\Containers\AppSection\Note\Data\Repositories\NoteRepository;
use App\Containers\AppSection\Note\Events\NoteUpdatedEvent;
use App\Containers\AppSection\Note\Models\Note;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdateNoteTask extends ParentTask
{
    public function __construct(
        protected NoteRepository $repository
    ) {
    }

    /**
     * @throws NotFoundException
     * @throws UpdateResourceFailedException
     */
    public function run(array $data, $id): Note
    {
        try {
            $note = $this->repository->update($data, $id);
            NoteUpdatedEvent::dispatch($note);

            return $note;
        } catch (ModelNotFoundException) {
            throw new NotFoundException();
        } catch (Exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
