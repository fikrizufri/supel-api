<?php

namespace App\Containers\AppSection\Voter\Actions;

use App\Containers\AppSection\Voter\Tasks\DeleteVoterTask;
use App\Containers\AppSection\Voter\UI\API\Requests\DeleteVoterRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteVoterAction extends ParentAction
{
    /**
     * @param DeleteVoterRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteVoterRequest $request): int
    {
        return app(DeleteVoterTask::class)->run($request->id);
    }
}
