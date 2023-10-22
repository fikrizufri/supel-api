<?php

namespace App\Containers\AppSection\User\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\User\Tasks\GetAdminGroupTask;
use App\Containers\AppSection\User\UI\API\Requests\GetAllUsersRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAdminGroupAction extends ParentAction
{
    /**
     * @return mixed
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllUsersRequest $request): mixed
    {
        return app(GetAdminGroupTask::class)->run($request);
    }
}
