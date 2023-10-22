<?php

namespace App\Containers\AppSection\Voter\UI\API\Controllers;


use App\Containers\AppSection\Voter\Actions\FindVotersAction;
use App\Containers\AppSection\Voter\UI\API\Requests\GetAllVotersRequest;
use App\Containers\AppSection\Voter\UI\API\Transformers\VoterSearchTransformer;
use App\Ship\Parents\Controllers\ApiController;

class FindVotersController extends ApiController
{

    public function get(GetAllVotersRequest $request): array
    {
        $voters = app(FindVotersAction::class)->run($request);

        return $this->transform($voters, VoterSearchTransformer::class);
    }

}
