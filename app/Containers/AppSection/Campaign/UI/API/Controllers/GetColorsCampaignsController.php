<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;

use App\Containers\AppSection\Campaign\Actions\GetColorsCampaignsAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\GetAllCampaignsRequest;
use App\Ship\Parents\Controllers\ApiController;

class GetColorsCampaignsController extends ApiController
{

    public function getColors(GetAllCampaignsRequest $request)
    {
        $campaigns = app(GetColorsCampaignsAction::class)->run($request);

        return $this->json($campaigns);
    }

}
