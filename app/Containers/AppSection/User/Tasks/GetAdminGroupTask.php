<?php

namespace App\Containers\AppSection\User\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\User\Data\Repositories\UserRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAdminGroupTask extends ParentTask
{
    public function __construct(
        protected UserRepository $repository
    ) {
    }

    /**
     * @return mixed
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run($request): mixed
    {
        $user = $request->user();
        $campaignId = $user->campaign_id;
        $repo = $this->repository->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
                                 ->where('role_id', 3)
                                 ->whereIn('id', function ($query) use ($campaignId) {
                                    $query->from('timses')->whereIn('default_campaign_id', function ($q) use ($campaignId) {
                                            $q->from('campaigns')->where('id', $campaignId)->select('id_akun');
                                    })->select('user_id');
        });
        return $repo->paginate();
    }
}
