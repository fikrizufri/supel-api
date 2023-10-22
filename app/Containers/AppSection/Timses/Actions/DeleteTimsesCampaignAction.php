<?php

namespace App\Containers\AppSection\Timses\Actions;

use App\Containers\AppSection\Timses\Tasks\DeleteTimsesCampaignTask;
use App\Containers\AppSection\Timses\UI\API\Requests\DeleteTimsesCampaignRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteTimsesCampaignAction extends ParentAction
{
    /**
     * @param DeleteTimsesCampaignRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteTimsesCampaignRequest $request): int
    {
        return app(DeleteTimsesCampaignTask::class)->run($request->id);
    }
}
