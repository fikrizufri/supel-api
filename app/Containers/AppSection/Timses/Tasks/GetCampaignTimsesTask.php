<?php

namespace App\Containers\AppSection\Timses\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Timses\Data\Repositories\TimsesRepository;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetCampaignTimsesTask extends ParentTask
{
    public function __construct(
        protected TimsesRepository $repository
    )
    {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run($request): mixed
    {
        $user = $request->user();

        $repo = $this->repository->select([
            'timses.id',
            'timses.name'
        ])->orderBy('timses.name', 'asc');

        if ($user->hasRole('adminkandidat')) {

            $campaign = Campaign::where('id', $user->campaign_id)->select('id_akun')->first();

            $repo = $repo->where('timses.default_campaign_id', $campaign->id_akun);

        }

        if ($user->hasRole('admin')) {
            $groupId = $user->group_id;
            $repo = $repo->where('timses.group_id', $groupId);
        }

        if($user->hasRole('adminpartai')) {
            $repo = $repo->whereIn('timses.default_campaign_id', function ($query) use($user) {
                $query->from('campaigns')->where('kode_partai', $user->kode_partai)->select('id_akun');
            });
        }

        if (!$user->hasRole('superadmin') && !$user->hasRole('admin') && !$user->hasRole('adminkandidat') && !$user->hasRole('adminpartai')) {
            $timses = Timses::where('user_id', $user->id)->select('group_id')->first();

            $repo = $repo->where('timses.group_id', $timses->group_id);
        }

        return $repo->get();
    }
}
