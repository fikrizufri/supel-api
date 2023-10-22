<?php

namespace App\Containers\AppSection\Note\Actions;

use App\Containers\AppSection\Note\Models\Note;
use App\Containers\AppSection\Note\Tasks\FindNoteByIdTask;
use App\Containers\AppSection\Note\UI\API\Requests\FindNoteByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindNoteByIdAction extends ParentAction
{
    /**
     * @throws NotFoundException
     */
    public function run(FindNoteByIdRequest $request): Note
    {
        return app(FindNoteByIdTask::class)->run($request->id);
    }
}
