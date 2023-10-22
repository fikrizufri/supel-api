<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;

use App\Containers\AppSection\Campaign\Actions\GetAllCampaignsAction;
use App\Containers\AppSection\Campaign\Actions\GetGroupCampaignsAction;
use App\Containers\AppSection\Campaign\Actions\GetSubGroupCampaignsAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\GetAllCampaignsRequest;
use App\Containers\AppSection\Campaign\UI\API\Transformers\CampaignTransformer;
use App\Containers\AppSection\Campaign\UI\API\Transformers\GroupCampaignTransformer;
use App\Containers\AppSection\Campaign\UI\API\Transformers\SubGroupCampaignTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetAllCampaignsController extends ApiController
{

    public function getAllCampaigns(GetAllCampaignsRequest $request): array
    {
        $campaigns = app(GetAllCampaignsAction::class)->run($request);

        return $this->transform($campaigns, CampaignTransformer::class);
    }

    public function getGroupCampaigns(GetAllCampaignsRequest $request): array
    {
        $campaigns = app(GetGroupCampaignsAction::class)->run($request);

        return $this->transform($campaigns, GroupCampaignTransformer::class);
    }

    public function getSubGroupCampaigns(GetAllCampaignsRequest $request): array
    {
        $campaigns = app(GetSubGroupCampaignsAction::class)->run($request);

        return $this->transform($campaigns, SubGroupCampaignTransformer::class);
    }

}
