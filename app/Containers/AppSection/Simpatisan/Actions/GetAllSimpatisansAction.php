<?php

namespace App\Containers\AppSection\Simpatisan\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Simpatisan\Tasks\GetAllSimpatisansTask;
use App\Containers\AppSection\Simpatisan\UI\API\Requests\GetAllSimpatisansRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllSimpatisansAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllSimpatisansRequest $request): mixed
    {
        return app(GetAllSimpatisansTask::class)->run($request);
    }
}
