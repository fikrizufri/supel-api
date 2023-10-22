<?php

namespace App\Containers\AppSection\Partai\UI\API\Controllers;

use App\Containers\AppSection\Partai\Actions\DeletePartaiAction;
use App\Containers\AppSection\Partai\UI\API\Requests\DeletePartaiRequest;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class DeletePartaiController extends ApiController
{
    /**
     * @param DeletePartaiRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     * @throws NotFoundException
     */
    public function deletePartai(DeletePartaiRequest $request): JsonResponse
    {
        app(DeletePartaiAction::class)->run($request);

        return $this->noContent();
    }
}
