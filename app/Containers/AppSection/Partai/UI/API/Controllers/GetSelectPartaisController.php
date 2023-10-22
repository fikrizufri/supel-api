<?php

namespace App\Containers\AppSection\Partai\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Partai\Actions\GetSelectPartaisAction;
use App\Containers\AppSection\Partai\UI\API\Requests\GetAllPartaisRequest;
use App\Containers\AppSection\Partai\UI\API\Transformers\PartaiTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class GetSelectPartaisController extends ApiController
{
    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function get(GetAllPartaisRequest $request): array
    {
        $partais = app(GetSelectPartaisAction::class)->run($request);

        return $this->transform($partais, PartaiTransformer::class);
    }
}
