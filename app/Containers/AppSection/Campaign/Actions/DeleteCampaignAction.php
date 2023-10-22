<?php

namespace App\Containers\AppSection\Campaign\Actions;

use App\Containers\AppSection\Campaign\Tasks\DeleteCampaignTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\DeleteCampaignRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteCampaignAction extends ParentAction
{
    /**
     * @param DeleteCampaignRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteCampaignRequest $request): int
    {
        return app(DeleteCampaignTask::class)->run($request->id);
    }
}
