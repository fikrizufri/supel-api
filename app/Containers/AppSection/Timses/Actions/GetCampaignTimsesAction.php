<?php

namespace App\Containers\AppSection\Timses\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Timses\Tasks\GetCampaignTimsesTask;
use App\Containers\AppSection\Timses\UI\API\Requests\GetAllTimsesRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetCampaignTimsesAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllTimsesRequest $request): mixed
    {
        return app(GetCampaignTimsesTask::class)->run($request);
    }
}
