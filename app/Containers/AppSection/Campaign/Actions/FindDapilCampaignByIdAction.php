<?php

namespace App\Containers\AppSection\Campaign\Actions;

use App\Containers\AppSection\Campaign\Models\DapilCampaign;
use App\Containers\AppSection\Campaign\Tasks\FindDapilCampaignByIdTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\FindCampaignByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindDapilCampaignByIdAction extends ParentAction
{
    /**
     * @throws NotFoundException
     */
    public function run(FindCampaignByIdRequest $request): DapilCampaign
    {
        return app(FindDapilCampaignByIdTask::class)->run($request->id);
    }
}
