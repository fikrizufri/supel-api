<?php

namespace App\Containers\AppSection\Campaign\Actions;

use App\Containers\AppSection\Campaign\Models\VotersCampaign;
use App\Containers\AppSection\Campaign\Tasks\FindVoterCampaignByIdTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\FindVoterCampaignByIdRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;

class FindVoterCampaignByIdAction extends ParentAction
{
    /**
     * @throws NotFoundException
     */
    public function run(FindVoterCampaignByIdRequest $request): VotersCampaign
    {
        return app(FindVoterCampaignByIdTask::class)->run($request->id);
    }
}
