<?php

namespace App\Containers\AppSection\Partai\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Partai\Actions\GetAllPartaisAction;
use App\Containers\AppSection\Partai\UI\API\Requests\GetAllPartaisRequest;
use App\Containers\AppSection\Partai\UI\API\Transformers\PartaiTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllPartaisController extends ApiController
{
    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAllPartais(GetAllPartaisRequest $request): array
    {
        $partais = app(GetAllPartaisAction::class)->run($request);

        return $this->transform($partais, PartaiTransformer::class);
    }
}
