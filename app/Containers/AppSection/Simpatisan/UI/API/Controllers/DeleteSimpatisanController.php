<?php

namespace App\Containers\AppSection\Simpatisan\UI\API\Controllers;

use App\Containers\AppSection\Simpatisan\Actions\DeleteSimpatisanAction;
use App\Containers\AppSection\Simpatisan\UI\API\Requests\DeleteSimpatisanRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeleteSimpatisanController extends ApiController
{
    /**
     * @param DeleteSimpatisanRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function deleteSimpatisan(DeleteSimpatisanRequest $request): JsonResponse
    {
        app(DeleteSimpatisanAction::class)->run($request);

        return $this->noContent();
    }
}
