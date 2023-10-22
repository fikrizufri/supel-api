<?php

namespace App\Containers\AppSection\Partai\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Partai\Actions\GetAllPublicPartaisAction;
use App\Containers\AppSection\Partai\UI\API\Requests\GetAllPartaisRequest;
use App\Containers\AppSection\Partai\UI\API\Transformers\PartaiPublicTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllPublicPartaisController extends ApiController
{
    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAllPartais(GetAllPartaisRequest $request): array
    {
        $partais = app(GetAllPublicPartaisAction::class)->run($request);

        return $this->transform($partais, PartaiPublicTransformer::class);
    }
}
