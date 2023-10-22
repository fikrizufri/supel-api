<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;


use App\Containers\AppSection\Campaign\Actions\GetCampaignBySubGroupCampaignAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\ GetCampaignBySubGroupCampaignRequest;
use App\Containers\AppSection\Campaign\UI\API\Transformers\CampaignTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetCampaignBySubGroupCampaignController extends ApiController
{

    public function findById(GetCampaignBySubGroupCampaignRequest $request): array
    {
        $campaign = app(GetCampaignBySubGroupCampaignAction::class)->run($request);

        return $this->transform($campaign, CampaignTransformer::class);
    }
}
