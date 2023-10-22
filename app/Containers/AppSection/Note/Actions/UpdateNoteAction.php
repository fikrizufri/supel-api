<?php

namespace App\Containers\AppSection\Note\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Note\Models\Note;
use App\Containers\AppSection\Note\Tasks\UpdateNoteTask;
use App\Containers\AppSection\Note\UI\API\Requests\UpdateNoteRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateNoteAction extends ParentAction
{
    /**
     * @param UpdateNoteRequest $request
     * @return Note
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(UpdateNoteRequest $request): Note
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return app(UpdateNoteTask::class)->run($data, $request->id);
    }
}
