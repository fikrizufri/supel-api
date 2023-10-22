<?php

namespace App\Containers\AppSection\Note\Actions;

use App\Containers\AppSection\Note\Tasks\DeleteNoteTask;
use App\Containers\AppSection\Note\UI\API\Requests\DeleteNoteRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteNoteAction extends ParentAction
{
    /**
     * @param DeleteNoteRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteNoteRequest $request): int
    {
        return app(DeleteNoteTask::class)->run($request->id);
    }
}
