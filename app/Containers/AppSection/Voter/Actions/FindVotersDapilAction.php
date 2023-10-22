<?php

namespace App\Containers\AppSection\Voter\Actions;


use App\Containers\AppSection\Voter\Tasks\FindVotersDapilTask;
use App\Containers\AppSection\Voter\UI\API\Requests\GetAllVotersRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindVotersDapilAction extends ParentAction
{
    /**
     * @param GetAllVotersRequest $request
     * @return mixed
     */
    public function run(GetAllVotersRequest $request): mixed
    {
        return app(FindVotersDapilTask::class)->run($request);
    }
}
