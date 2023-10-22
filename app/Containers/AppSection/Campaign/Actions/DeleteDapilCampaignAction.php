<?php

namespace App\Containers\AppSection\Campaign\Actions;

use App\Containers\AppSection\Campaign\Models\DapilWilayahCampaign;
use App\Containers\AppSection\Campaign\Tasks\DeleteDapilCampaignTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\DeleteCampaignRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class DeleteDapilCampaignAction extends ParentAction
{
    /**
     * @param DeleteCampaignRequest $request
     * @return int
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function run(DeleteCampaignRequest $request): int
    {
        DapilWilayahCampaign::where('dapil_id', $request->id)->delete();
        return app(DeleteDapilCampaignTask::class)->run($request->id);
    }
}
