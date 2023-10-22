<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;


use App\Containers\AppSection\Authentication\Actions\RegisterNewCampaignAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterNewCampaignRequest;
use App\Ship\Parents\Controllers\ApiController;

class RegisterNewCampaignController extends ApiController
{

    public function register(RegisterNewCampaignRequest $request)
    {
        $timses = app(RegisterNewCampaignAction::class)->transactionalRun($request);

        return $this->json($timses);
    }

}
