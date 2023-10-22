<?php

namespace App\Containers\AppSection\Campaign\Actions;


use App\Containers\AppSection\Campaign\Tasks\GetColorsCampaignsTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\GetAllCampaignsRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class GetColorsCampaignsAction extends ParentAction
{
    public function run(GetAllCampaignsRequest $request): mixed
    {
        return app(GetColorsCampaignsTask::class)->run($request);
    }
}
