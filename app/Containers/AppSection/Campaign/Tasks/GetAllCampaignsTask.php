<?php

namespace App\Containers\AppSection\Campaign\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Campaign\Data\Criterias\PartaiFilterCriteria;
use App\Containers\AppSection\Campaign\Data\Criterias\SubGroupFilterCriteria;
use App\Containers\AppSection\Campaign\Data\Repositories\CampaignRepository;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllCampaignsTask extends ParentTask
{
    public function __construct(
        protected CampaignRepository $repository
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

        $repo = $this->repository->whereIn('active', [0, 1]);

        if ($user->hasRole('adminkandidat') || $user->hasRole('admin')) {
            return $repo->where('id', $user->campaign_id)->get();
        }

        if ($user->hasRole('adminpartai')) {
            $this->repository->pushCriteria(new PartaiFilterCriteria($user->kode_partai));
            return $this->addRequestCriteria()->repository->paginate();
        }

        if ($user->hasRole('superadmin')) {
            $subGroup = $request->get('subgroup_campaign_id');
            $partai = $request->get('partai');
            if ($subGroup) {
                $this->repository->pushCriteria(new SubGroupFilterCriteria($subGroup));
            }
            if ($partai) {
                $this->repository->pushCriteria(new PartaiFilterCriteria($partai));
            }
            return $this->addRequestCriteria()->repository->paginate();
        }

        $timses = Timses::whereUserId($user->id)->first();

        if (!$timses) {
            throw new NotFoundException('Data timses tidak diketemukan.');
        }

        $campaign = Campaign::where('id_akun', $timses->default_campaign_id)->select('subgroup_campaign_id', 'kode_dapil')->first();

        if (!$campaign) {
            throw new NotFoundException('Data kandidat tidak diketemukan.');
        }

        if (in_array((int)$campaign->subgroup_campaign_id, [2, 5, 6])) {
            $repo = $repo->where('kode_dapil', $campaign->kode_dapil)->orderBy('kode_partai', 'asc')->orderBy('nomor_urut', 'asc');
        } else {
            $repo = $repo->where('kode_dapil', $campaign->kode_dapil)->orderBy('nomor_urut', 'asc');
        }

        $repo = $repo->where('subgroup_campaign_id', $campaign->subgroup_campaign_id);
        return $repo->get();

    }
}
