<?php

namespace App\Containers\AppSection\Group\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Group\Tasks\GetAllGroupsTask;
use App\Containers\AppSection\Group\UI\API\Requests\GetAllGroupsRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllGroupsAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllGroupsRequest $request): mixed
    {
        return app(GetAllGroupsTask::class)->run($request);
    }
}
