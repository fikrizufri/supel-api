<?php

namespace App\Containers\AppSection\Group\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Group\Data\Repositories\GroupRepository;
use App\Containers\AppSection\Group\Events\GroupsListedEvent;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetSelectGroupsTask extends ParentTask
{
    public function __construct(
        protected GroupRepository $repository
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run($request): mixed
    {
        $repo = $this->repository->orderBy('group_name')->where('campaign_id', $request->get('campaign_id'));
        return $repo->get();
    }
}
