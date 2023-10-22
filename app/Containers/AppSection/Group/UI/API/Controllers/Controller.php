<?php

namespace App\Containers\AppSection\Group\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Group\Actions\CreateGroupAction;
use App\Containers\AppSection\Group\Actions\DeleteGroupAction;
use App\Containers\AppSection\Group\Actions\FindGroupByIdAction;
use App\Containers\AppSection\Group\Actions\GetAllGroupsAction;
use App\Containers\AppSection\Group\Actions\UpdateGroupAction;
use App\Containers\AppSection\Group\UI\API\Requests\CreateGroupRequest;
use App\Containers\AppSection\Group\UI\API\Requests\DeleteGroupRequest;
use App\Containers\AppSection\Group\UI\API\Requests\FindGroupByIdRequest;
use App\Containers\AppSection\Group\UI\API\Requests\GetAllGroupsRequest;
use App\Containers\AppSection\Group\UI\API\Requests\UpdateGroupRequest;
use App\Containers\AppSection\Group\UI\API\Transformers\GroupTransformer;
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
     * @param CreateGroupRequest $request
     * @return JsonResponse
     * @throws InvalidTransformerException
     * @throws CreateResourceFailedException
     */
    public function createGroup(CreateGroupRequest $request): JsonResponse
    {
        $group = app(CreateGroupAction::class)->run($request);

        return $this->created($this->transform($group, GroupTransformer::class));
    }

    /**
     * @param FindGroupByIdRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws NotFoundException
     */
    public function findGroupById(FindGroupByIdRequest $request): array
    {
        $group = app(FindGroupByIdAction::class)->run($request);

        return $this->transform($group, GroupTransformer::class);
    }

    /**
     * @param GetAllGroupsRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAllGroups(GetAllGroupsRequest $request): array
    {
        $groups = app(GetAllGroupsAction::class)->run($request);

        return $this->transform($groups, GroupTransformer::class);
    }

    /**
     * @param UpdateGroupRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     */
    public function updateGroup(UpdateGroupRequest $request)
    {
        $group = app(UpdateGroupAction::class)->run($request);

        return $this->transform($group, GroupTransformer::class);
    }

    /**
     * @param DeleteGroupRequest $request
     * @return JsonResponse
     * @throws DeleteResourceFailedException
     */
    public function deleteGroup(DeleteGroupRequest $request): JsonResponse
    {
        app(DeleteGroupAction::class)->run($request);

        return $this->noContent();
    }
}
