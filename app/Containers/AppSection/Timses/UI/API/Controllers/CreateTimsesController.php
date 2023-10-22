<?php

namespace App\Containers\AppSection\Timses\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Timses\Actions\CreateTimsesAction;
use App\Containers\AppSection\Timses\UI\API\Requests\CreateTimsesRequest;
use App\Containers\AppSection\Timses\UI\API\Transformers\TimsesTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreateTimsesController extends ApiController
{
    /**
     * @param CreateTimsesRequest $request
     * @return JsonResponse
     * @throws CreateResourceFailedException
     * @throws InvalidTransformerException
     * @throws IncorrectIdException
     */
    public function createTimses(CreateTimsesRequest $request): JsonResponse
    {
        $timses = app(CreateTimsesAction::class)->run($request);

        return $this->created($this->transform($timses, TimsesTransformer::class));
    }
}
