<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;


use App\Containers\AppSection\Campaign\Actions\CreateVotersCampaignAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\CreateVotersCampaignRequest;
use App\Containers\AppSection\Campaign\UI\API\Transformers\VotersCampaignTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreateVotersCampaignController extends ApiController
{

    public function CreateVoters(CreateVotersCampaignRequest $request)
    {
        app(CreateVotersCampaignAction::class)->run($request);

        return $this->json('sukses', 200);
    }
}
