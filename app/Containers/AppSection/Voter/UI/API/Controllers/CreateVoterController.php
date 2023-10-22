<?php

namespace App\Containers\AppSection\Voter\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Voter\Actions\CreateVoterAction;
use App\Containers\AppSection\Voter\UI\API\Requests\CreateVoterRequest;
use App\Containers\AppSection\Voter\UI\API\Transformers\VoterTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreateVoterController extends ApiController
{
    /**
     * @param CreateVoterRequest $request
     * @return JsonResponse
     * @throws CreateResourceFailedException
     * @throws InvalidTransformerException
     * @throws IncorrectIdException
     */
    public function createVoter(CreateVoterRequest $request): JsonResponse
    {
        $voter = app(CreateVoterAction::class)->run($request);

        return $this->created($this->transform($voter, VoterTransformer::class));
    }
}
