<?php

namespace App\Containers\AppSection\Capres\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Capres\Actions\CreateCapresAction;
use App\Containers\AppSection\Capres\Actions\DeleteCapresAction;
use App\Containers\AppSection\Capres\Actions\FindCapresByIdAction;
use App\Containers\AppSection\Capres\Actions\GetAllCapresAction;
use App\Containers\AppSection\Capres\Actions\UpdateCapresAction;
use App\Containers\AppSection\Capres\UI\API\Requests\CreateCapresRequest;
use App\Containers\AppSection\Capres\UI\API\Requests\DeleteCapresRequest;
use App\Containers\AppSection\Capres\UI\API\Requests\FindCapresByIdRequest;
use App\Containers\AppSection\Capres\UI\API\Requests\GetAllCapresRequest;
use App\Containers\AppSection\Capres\UI\API\Requests\UpdateCapresRequest;
use App\Containers\AppSection\Capres\UI\API\Transformers\CapresTransformer;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\DeleteResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;
use Prettus\Repository\Exceptions\RepositoryException;

class Controller extends ApiController
{
    /**
     * @param CreateCapresRequest $request
     * @return JsonResponse
     * @throws InvalidTransformerException
     * @throws CreateResourceFailedException
     */
    public function createCapres(CreateCapresRequest $request): JsonResponse
    {
        $capres = app(CreateCapresAction::class)->run($request);

        return $this->created($this->transform($capres, CapresTransformer::class));
    }

    /**
     * @param FindCapresByIdRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function findCapresById(FindCapresByIdRequest $request): array
    {
        $capres = app(FindCapresByIdAction::class)->run($request);

        return $this->transform($capres, CapresTransformer::class);
    }

    /**
     * @param GetAllCapresRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAllCapres(GetAllCapresRequest $request): array
    {
        $capres = app(GetAllCapresAction::class)->run($request);

        return $this->transform($capres, CapresTransformer::class);
    }

    /**
     * @param UpdateCapresRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     */
    public function updateCapres(UpdateCapresRequest $request): array
    {
        $capres = app(UpdateCapresAction::class)->run($request);

        return $this->transform($capres, CapresTransformer::class);
    }

    /**
     * @param DeleteCapresRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     */
    public function deleteCapres(DeleteCapresRequest $request): JsonResponse
    {
        app(DeleteCapresAction::class)->run($request);

        return $this->noContent();
    }
}
