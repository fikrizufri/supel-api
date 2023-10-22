<?php

namespace App\Containers\AppSection\Campaign\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Campaign\Tasks\GetAllTimsesVotersKelurahanTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\GetAllVotersCampaignsRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllTimsesVotersKelurahanAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllVotersCampaignsRequest $request): mixed
    {
        return app(GetAllTimsesVotersKelurahanTask::class)->run($request);
    }
}
