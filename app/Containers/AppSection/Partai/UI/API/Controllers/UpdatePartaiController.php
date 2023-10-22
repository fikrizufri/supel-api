<?php

namespace App\Containers\AppSection\Partai\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Partai\Actions\UpdatePartaiAction;
use App\Containers\AppSection\Partai\UI\API\Requests\UpdatePartaiRequest;
use App\Containers\AppSection\Partai\UI\API\Transformers\PartaiTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;

class UpdatePartaiController extends ApiController
{
    /**
     * @param UpdatePartaiRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function updatePartai(UpdatePartaiRequest $request): array
    {
        $partai = app(UpdatePartaiAction::class)->run($request);

        return $this->transform($partai, PartaiTransformer::class);
    }
}
