<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;

use App\Containers\AppSection\Campaign\Actions\GetDapilWilayahCampaignsAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\GetDapilWilayahCampaignRequest;
use App\Containers\AppSection\Campaign\UI\API\Transformers\DapilWilayahCampaignTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetDapilWilayahCampaignsController extends ApiController
{

    public function getDapilCampaigns(GetDapilWilayahCampaignRequest $request): array
    {
        $campaigns = app(GetDapilWilayahCampaignsAction::class)->run($request);

        return $this->transform($campaigns, DapilWilayahCampaignTransformer::class);
    }

}
