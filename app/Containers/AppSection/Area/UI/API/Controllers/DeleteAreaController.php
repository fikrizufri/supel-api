<?php

namespace App\Containers\AppSection\Area\UI\API\Controllers;

use App\Containers\AppSection\Area\Actions\DeleteAreaAction;
use App\Containers\AppSection\Area\UI\API\Requests\DeleteAreaRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeleteAreaController extends ApiController
{
    /**
     * @param DeleteAreaRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function deleteArea(DeleteAreaRequest $request): JsonResponse
    {
        app(DeleteAreaAction::class)->run($request);

        return $this->noContent();
    }
}
