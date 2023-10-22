<?php

namespace App\Containers\AppSection\Group\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Group\Actions\GetSelectGroupsAction;
use App\Containers\AppSection\Group\UI\API\Requests\GetAllGroupsRequest;
use App\Containers\AppSection\Group\UI\API\Transformers\GroupTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class GetSelectController extends ApiController
{
    /**
     * @param GetAllGroupsRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function get(GetAllGroupsRequest $request): array
    {
        $groups = app(GetSelectGroupsAction::class)->run($request);

        return $this->transform($groups, GroupTransformer::class);
    }

}
