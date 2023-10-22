<?php

namespace App\Containers\AppSection\Group\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Group\Data\Repositories\GroupRepository;
use App\Containers\AppSection\Group\Events\GroupsListedEvent;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllGroupsTask extends ParentTask
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
        $user = $request->user();
        $repo = $this->repository->orderBy('id');
        if($user->hasRole('adminkandidat')) {
            $repo = $repo->where('campaign_id' ,  $user->campaign_id);
        } elseif ($user->hasRole('admin')) {
            $timses = Timses::where('user_id', $user->id)->select('default_campaign_id')->first();
            $campaign = Campaign::where('id_akun', $timses->default_campaign_id)->select('id')->first();
            $repo = $repo->where('campaign_id' ,  $campaign->id);
        }
        return $repo->paginate();
    }
}
