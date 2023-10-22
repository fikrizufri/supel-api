<?php

namespace App\Containers\AppSection\Note\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Note\Tasks\GetAllNotesTask;
use App\Containers\AppSection\Note\UI\API\Requests\GetAllNotesRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllNotesAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllNotesRequest $request): mixed
    {
        return app(GetAllNotesTask::class)->run();
    }
}
