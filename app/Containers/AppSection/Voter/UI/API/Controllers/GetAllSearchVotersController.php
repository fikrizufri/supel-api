<?php

namespace App\Containers\AppSection\Voter\UI\API\Controllers;


use App\Containers\AppSection\Voter\Actions\GetAllSearchVotersAction;
use App\Containers\AppSection\Voter\UI\API\Requests\GetAllVotersRequest;
use App\Containers\AppSection\Voter\UI\API\Transformers\VoterSearchTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetAllSearchVotersController extends ApiController
{

    public function getAllVoters(GetAllVotersRequest $request): array
    {
        $voters = app(GetAllSearchVotersAction::class)->run($request);

        return $this->transform($voters, VoterSearchTransformer::class);
    }

}
