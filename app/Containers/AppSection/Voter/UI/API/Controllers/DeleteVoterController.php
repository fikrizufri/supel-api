<?php

namespace App\Containers\AppSection\Voter\UI\API\Controllers;

use App\Containers\AppSection\Voter\Actions\DeleteVoterAction;
use App\Containers\AppSection\Voter\UI\API\Requests\DeleteVoterRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeleteVoterController extends ApiController
{
    /**
     * @param DeleteVoterRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function deleteVoter(DeleteVoterRequest $request): JsonResponse
    {
        app(DeleteVoterAction::class)->run($request);

        return $this->noContent();
    }
}
