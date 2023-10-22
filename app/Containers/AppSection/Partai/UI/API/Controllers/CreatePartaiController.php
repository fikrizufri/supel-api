<?php

namespace App\Containers\AppSection\Partai\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Partai\Actions\CreatePartaiAction;
use App\Containers\AppSection\Partai\UI\API\Requests\CreatePartaiRequest;
use App\Containers\AppSection\Partai\UI\API\Transformers\PartaiTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreatePartaiController extends ApiController
{
    /**
     * @param CreatePartaiRequest $request
     * @return JsonResponse
     * @throws CreateResourceFailedException
     * @throws InvalidTransformerException
     * @throws IncorrectIdException
     */
    public function createPartai(CreatePartaiRequest $request): JsonResponse
    {
        $partai = app(CreatePartaiAction::class)->run($request);

        return $this->created($this->transform($partai, PartaiTransformer::class));
    }
}
