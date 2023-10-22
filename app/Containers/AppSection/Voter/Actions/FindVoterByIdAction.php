<?php

namespace App\Containers\AppSection\Voter\Actions;

use App\Containers\AppSection\Voter\Models\Voter;
use App\Containers\AppSection\Voter\Tasks\FindVoterByIdTask;
use App\Containers\AppSection\Voter\UI\API\Requests\FindVoterByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindVoterByIdAction extends ParentAction
{
    /**
     * @throws NotFoundException
     */
    public function run(FindVoterByIdRequest $request): Voter
    {
        return app(FindVoterByIdTask::class)->run($request->id);
    }
}
