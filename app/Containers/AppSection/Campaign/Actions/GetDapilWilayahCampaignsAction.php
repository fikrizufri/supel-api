<?php

namespace App\Containers\AppSection\Campaign\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Campaign\Tasks\GetDapilWilayahCampaignsTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\GetDapilWilayahCampaignRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetDapilWilayahCampaignsAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetDapilWilayahCampaignRequest $request): mixed
    {
        return app(GetDapilWilayahCampaignsTask::class)->run($request);
    }
}
