<?php

namespace App\Containers\AppSection\Partai\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Partai\Actions\FindPartaiByIdAction;
use App\Containers\AppSection\Partai\UI\API\Requests\FindPartaiByIdRequest;
use App\Containers\AppSection\Partai\UI\API\Transformers\PartaiTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Controllers\ApiController;

class FindPartaiByIdController extends ApiController
{
    /**
     * @throws InvalidTransformerException|NotFoundException
     */
    public function findPartaiById(FindPartaiByIdRequest $request): array
    {
        $partai = app(FindPartaiByIdAction::class)->run($request);

        return $this->transform($partai, PartaiTransformer::class);
    }
}
