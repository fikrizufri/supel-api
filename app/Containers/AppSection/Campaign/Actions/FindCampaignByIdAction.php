<?php

namespace App\Containers\AppSection\Campaign\Actions;

use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Campaign\Tasks\FindCampaignByIdTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\FindCampaignByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindCampaignByIdAction extends ParentAction
{
    /**
     * @throws NotFoundException
     */
    public function run(FindCampaignByIdRequest $request): Campaign
    {
        return app(FindCampaignByIdTask::class)->run($request->id);
    }
}
