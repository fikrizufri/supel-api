<?php

namespace App\Containers\AppSection\Capres\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Capres\Tasks\GetAllCapresTask;
use App\Containers\AppSection\Capres\UI\API\Requests\GetAllCapresRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllCapresAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllCapresRequest $request): mixed
    {
        return app(GetAllCapresTask::class)->run();
    }
}
