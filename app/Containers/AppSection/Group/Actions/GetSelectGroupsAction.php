<?php

namespace App\Containers\AppSection\Group\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Group\Tasks\GetSelectGroupsTask;
use App\Containers\AppSection\Group\UI\API\Requests\GetAllGroupsRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetSelectGroupsAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllGroupsRequest $request): mixed
    {
        return app(GetSelectGroupsTask::class)->run($request);
    }
}
