<?php

namespace App\Containers\AppSection\Campaign\Actions;

use App\Containers\AppSection\Campaign\Models\SubGroupCampaign;
use App\Containers\AppSection\Campaign\Tasks\FindSubGroupCampaignByIdTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\FindSubGroupCampaignByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindSubGroupCampaignByIdAction extends ParentAction
{
    /**
     * @throws NotFoundException
     */
    public function run(FindSubGroupCampaignByIdRequest $request): SubGroupCampaign
    {
        return app(FindSubGroupCampaignByIdTask::class)->run($request->id);
    }
}
