<?php

namespace App\Containers\AppSection\Timses\UI\API\Controllers;

use App\Containers\AppSection\Timses\Actions\DeleteTimsesAction;
use App\Containers\AppSection\Timses\UI\API\Requests\DeleteTimsesRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeleteTimsesController extends ApiController
{
    /**
     * @param DeleteTimsesRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function deleteTimses(DeleteTimsesRequest $request): JsonResponse
    {
        app(DeleteTimsesAction::class)->run($request);

        return $this->noContent();
    }
}
