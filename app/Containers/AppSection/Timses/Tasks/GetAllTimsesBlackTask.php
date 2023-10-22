<?php

namespace App\Containers\AppSection\Timses\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Timses\Data\Criterias\JoinCampaignBlackCriteria;
use App\Containers\AppSection\Timses\Data\Criterias\WhereCampaignCriteria;
use App\Containers\AppSection\Timses\Data\Repositories\TimsesRepository;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllTimsesBlackTask extends ParentTask
{
    public function __construct(
        protected TimsesRepository $repository
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run($request): mixed
    {
        $user = $request->user();

        $repo =  $this->repository->join('timses_campaign', 'timses.id', '=', 'timses_campaign.timses_id')
            ->where('timses_campaign.status', 'unapproved')
            ->select([
                DB::raw('(SELECT t.name FROM campaigns t WHERE t.id_akun=timses_campaign.campaign_id LIMIT 1) as kandidat'),
                'timses.id',
                'timses.user_id',
                'timses.default_campaign_id',
                'timses.name',
                'timses.nick_name',
                'timses.phone',
                'timses.nik',
                'timses.id_akun',
                'timses.group_id',
                'timses.id_timses_recommend',
                'timses.created_at',
                'timses_campaign.status',
                'timses_campaign.saksi',
                'timses_campaign.id as timses_campaign_id',
            ])->orderBy('timses.id', 'asc');

        if($user->hasRole('adminkandidat')) {
            $campaign = Campaign::where('id', $user->campaign_id)->select('id_akun')->first();
            if ($campaign) {
                $repo = $repo->where('timses_campaign.campaign_id', $campaign->id_akun);
            }
        }

        if($user->hasRole('admin')) {
            $groupId = $user->group_id;
            $repo = $repo->where('timses.group_id', $groupId);
        }

        if($user->hasRole('adminpartai')) {
            $repo = $repo->whereIn('timses.default_campaign_id', function ($query) use($user) {
                $query->from('campaigns')->where('kode_partai', $user->kode_partai)->select('id_akun');
            });
        }

        if(!$user->hasRole('superadmin') && !$user->hasRole('admin') && !$user->hasRole('adminkandidat') && !$user->hasRole('adminpartai')) {
            $timses = Timses::where('user_id', $user->id)->select('group_id')->first();
            $repo = $repo->where('timses.group_id', $timses->group_id);
        }

        return $repo->paginate();
    }
}
