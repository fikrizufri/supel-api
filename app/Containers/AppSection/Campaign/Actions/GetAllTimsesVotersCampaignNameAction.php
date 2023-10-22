<?php

namespace App\Containers\AppSection\Campaign\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Campaign\Tasks\GetAllTimsesVotersCampiagnNameTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\GetAllVotersCampaignsRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllTimsesVotersCampaignNameAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllVotersCampaignsRequest $request): mixed
    {
        return app(GetAllTimsesVotersCampiagnNameTask::class)->run($request);
    }
}
