<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;


use App\Containers\AppSection\Campaign\Actions\GetAllVotersCampaignsAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\GetAllVotersCampaignsRequest;
use App\Containers\AppSection\Campaign\UI\API\Transformers\AllVotersCampaignTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetAllVotersCampaignsController extends ApiController
{
    public function getAllVotersCampaigns(GetAllVotersCampaignsRequest $request): array
    {
        $campaigns = app(GetAllVotersCampaignsAction::class)->run($request);

        return $this->transform($campaigns, AllVotersCampaignTransformer::class);
    }
}
