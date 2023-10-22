<?php

namespace App\Containers\AppSection\Voter\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Voter\Actions\FindVoterByIdAction;
use App\Containers\AppSection\Voter\UI\API\Requests\FindVoterByIdRequest;
use App\Containers\AppSection\Voter\UI\API\Transformers\VoterTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class FindVoterByIdController extends ApiController
{
    /**
     * @throws InvalidTransformerException|NotFoundException
     */
    public function findVoterById(FindVoterByIdRequest $request): array
    {
        $voter = app(FindVoterByIdAction::class)->run($request);

        return $this->transform($voter, VoterTransformer::class);
    }
}
