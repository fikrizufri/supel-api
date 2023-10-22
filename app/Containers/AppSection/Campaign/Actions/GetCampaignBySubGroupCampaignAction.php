<?php

namespace App\Containers\AppSection\Campaign\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Campaign\Tasks\GetCampaignBySubGroupCampaignTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\GetAllCampaignsRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetCampaignBySubGroupCampaignAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllCampaignsRequest $request): mixed
    {
        return app(GetCampaignBySubGroupCampaignTask::class)->run($request);
    }
}
