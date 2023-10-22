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

class GetSelectCampaignsTask extends ParentTask
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

        if ($request->search) {
            $repo = $repo->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->partai) {
            $repo = $repo->where('kode_partai',  $request->partai);
        }

        if ($request->subgroup_campaign_id) {
            $repo = $repo->where('subgroup_campaign_id', $request->subgroup_campaign_id);
        }

        if ($user->hasRole('superadmin')) {
            return $repo->select('id', 'id_akun', 'name')->get();
        }

        if ($user->hasRole('adminkandidat') || $user->hasRole('admin') || $user->hasRole('adminpartai')) {

            $campaign = Campaign::where('id', $user->campaign_id)->select('subgroup_campaign_id', 'kode_dapil')->first();

        } else {
            $timses = Timses::whereUserId($user->id)->first();

            if (!$timses) {
                throw new NotFoundException('Data timses tidak diketemukan.');
            }

            $campaign = Campaign::where('id_akun', $timses->default_campaign_id)->select('subgroup_campaign_id', 'kode_dapil')->first();
        }

        if (!$campaign) {
            throw new NotFoundException('Data kandidat tidak diketemukan.');
        }

        if (in_array((int)$campaign->subgroup_campaign_id, [2, 5, 6])) {
            $repo = $repo->where('kode_dapil', $campaign->kode_dapil)->orderBy('kode_partai', 'asc')->orderBy('nomor_urut', 'asc');
        } else {
            $repo = $repo->where('kode_dapil', $campaign->kode_dapil)->orderBy('nomor_urut', 'asc');
        }

        return $repo->get();

    }
}
