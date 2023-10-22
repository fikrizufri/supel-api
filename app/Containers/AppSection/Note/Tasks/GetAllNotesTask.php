<?php

namespace App\Containers\AppSection\Note\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Note\Data\Repositories\NoteRepository;
use App\Containers\AppSection\Note\Events\NotesListedEvent;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllNotesTask extends ParentTask
{
    public function __construct(
        protected NoteRepository $repository
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(): mixed
    {
        $result = $this->addRequestCriteria()->repository->paginate();
        NotesListedEvent::dispatch($result);

        return $result;
    }
}
