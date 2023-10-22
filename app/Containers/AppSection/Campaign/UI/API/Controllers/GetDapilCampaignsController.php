<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;

use App\Containers\AppSection\Campaign\Actions\GetDapilCampaignsAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\GetAllCampaignsRequest;
use App\Containers\AppSection\Campaign\UI\API\Transformers\DapilCampaignTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetDapilCampaignsController extends ApiController
{

    public function getDapilCampaigns(GetAllCampaignsRequest $request): array
    {
        $campaigns = app(GetDapilCampaignsAction::class)->run($request);

        return $this->transform($campaigns, DapilCampaignTransformer::class);
    }

}
