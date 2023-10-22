<?php

namespace App\Containers\AppSection\Voter\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Voter\Actions\UpdateVoterAction;
use App\Containers\AppSection\Voter\UI\API\Requests\UpdateVoterRequest;
use App\Containers\AppSection\Voter\UI\API\Transformers\VoterTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;

class UpdateVoterController extends ApiController
{
    /**
     * @param UpdateVoterRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function updateVoter(UpdateVoterRequest $request): array
    {
        $voter = app(UpdateVoterAction::class)->run($request);

        return $this->transform($voter, VoterTransformer::class);
    }
}
