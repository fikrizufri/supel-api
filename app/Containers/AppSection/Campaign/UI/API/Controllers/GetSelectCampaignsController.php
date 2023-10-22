<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;

use App\Containers\AppSection\Campaign\Actions\GetSelectCampaignsAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\GetAllCampaignsRequest;
use App\Containers\AppSection\Campaign\UI\API\Transformers\SelectCampaignTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetSelectCampaignsController extends ApiController
{

    public function get(GetAllCampaignsRequest $request): array
    {
        $campaigns = app(GetSelectCampaignsAction::class)->run($request);

        return $this->transform($campaigns, SelectCampaignTransformer::class);
    }
}
