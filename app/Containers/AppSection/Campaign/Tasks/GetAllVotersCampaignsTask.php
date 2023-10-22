<?php

namespace App\Containers\AppSection\Campaign\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Campaign\Data\Criterias\VotersCampaignCriteria;
use App\Containers\AppSection\Campaign\Data\Criterias\WhereVotersCampaignCriteria;
use App\Containers\AppSection\Campaign\Data\Repositories\VotersCampaignRepository;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Timses\Data\Criterias\WhereCampaignCriteria;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllVotersCampaignsTask extends ParentTask
{
    public function __construct(
        protected VotersCampaignRepository $repository
    ) {
    }

    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run($request): mixed
    {
        $user = $request->user();

        $repo = $this->repository->leftJoin('campaigns', 'voters_campaign.campaign_id', '=', 'campaigns.id')
            ->join('voters', 'voters_campaign.voters_id', '=', 'voters.id');

        if($user->hasRole('adminkandidat')) {
            $campaign =  Campaign::whereId($user->campaign_id)->select('subgroup_campaign_id', 'kode_kabupaten', 'kode_dapil')->first();

            if ((int)$campaign->subgroup_campaign_id == 6) {
                $repo = $repo->where('voters_campaign.subgroup_campaign_id', $campaign->subgroup_campaign_id)->whereIn('voters_campaign.voters_id', function ($query) use($campaign) {
                    $query->from('voters')->whereIn('kode_kecamatan', function ($q) use($campaign) {
                        $q->from('dapil_wilayah')
                            ->where('dapil_id', $campaign->kode_dapil )->select('kode_kecamatan');
                    })->select('id');
                });
            }

            if (in_array((int)$campaign->subgroup_campaign_id, [3, 5])) {
                $repo = $repo->where('voters_campaign.subgroup_campaign_id', $campaign->subgroup_campaign_id)->whereIn('voters_campaign.voters_id', function ($query) use($campaign) {
                    $query->from('voters')->whereIn('kode_kabupaten', function ($q) use($campaign) {
                        $q->from('dapil_wilayah')
                            ->where('dapil_id', $campaign->kode_dapil )->select('kode_kabupaten');
                    })->select('id');
                });
            }

            if ((int)$campaign->subgroup_campaign_id == 2) {
                $repo = $repo->where('voters_campaign.subgroup_campaign_id', $campaign->subgroup_campaign_id)->whereIn('voters_campaign.voters_id', function ($query) use($campaign) {
                    $query->from('voters')->where('kode_kabupaten', $campaign->kode_kabupaten)->select('id');
                });
            }

        }

        if($user->hasRole('admin')) {
            $groupId = $user->group_id;
            $repo = $repo->whereIn('voters_campaign.timses_id', function ($query) use($groupId) {
                $query->from('timses')->where('group_id', $groupId)->select('id');
            });
        }

        if($user->hasRole('adminpartai')) {
            $repo = $repo->whereIn('voters_campaign.campaign_id', function ($query) use($user) {
                $query->from('campaigns')->where('kode_partai', $user->kode_partai)->select('id');
            });
        }

        if(!$user->hasRole('superadmin') && !$user->hasRole('admin') && !$user->hasRole('adminkandidat')  && !$user->hasRole('adminpartai')) {
            $timses = Timses::where('user_id', $user->id)->select('id')->first();
            $repo = $repo->where('voters_campaign.timses_id', $timses->id);
        }

        if ($request->search) {
            $repo = $repo->where('voters.name', 'like', '%' . $request->search . '%')
                ->orWhere('voters.tempat_lahir', 'like', '%' . $request->search . '%');
        }

        if ($request->status) {
            $repo = $repo->where('voters_campaign.status', '=', $request->status);
        }

        if ($request->kodeKabupaten) {
            $repo = $repo->where('voters.kode_kabupaten', '=', $request->kodeKabupaten);
        }

        if ($request->kodeKecamatan) {
            $repo = $repo->where('voters.kode_kecamatan', '=', $request->kodeKecamatan);
        }

        if ($request->kodeDesa) {
            $repo = $repo->where('voters.kode_desa', '=', $request->kodeDesa);
        }

        if ($request->kodeTimses) {
            $repo = $repo->where('voters_campaign.timses_id', '=', $request->kodeTimses);
        }

        if ($request->campaign) {
            $repo = $repo->where('campaigns.id', '=', $request->campaign);
        }

        if ($request->status) {
            $repo = $repo->where('voters_campaign.status', '=', $request->status);
        }

        if ($request->tps) {
            $repo = $repo->where('voters.tps', '=', $request->tps);
        }

        $repo =  $repo->select([
            'voters_campaign.*',
            'campaigns.name as campaign_name',
            'campaigns.id_akun as akun',
            'campaigns.singkatan',
            DB::raw('(SELECT t.name FROM timses t WHERE t.id=voters_campaign.timses_id LIMIT 1) as timses'),
            DB::raw('(SELECT t.kode FROM subgroup_campaigns t WHERE t.id=campaigns.subgroup_campaign_id LIMIT 1) as kode_sub'),
            DB::raw('(SELECT p.name FROM subgroup_campaigns p WHERE p.id=campaigns.subgroup_campaign_id LIMIT 1) as name_sub'),
            'voters.kode_provinsi',
            'voters.kode_kabupaten',
            'voters.kode_kecamatan',
            'voters.kode_desa',
            'voters.alamat',
            'voters.name as voter_name',
            'voters.nkk',
            'voters.nik',
            'voters.umur',
            'voters.tempat_lahir',
            'voters.tanggal_lahir',
            'voters.jenis_kelamin',
            'voters.kawin',
            'voters.tps',
            'voters.ktp',
            'voters.phone'
        ])->orderBy('campaigns.nomor_urut', 'desc')
            ->orderBy('voters.kode_kabupaten', 'desc')
            ->orderBy('voters.kode_kecamatan', 'desc')
            ->orderBy('voters.kode_desa', 'desc')
            ->orderBy('voters.tps', 'desc')
            ->orderBy('voters_campaign.timses_id', 'desc')
            ->orderBy('voters.name', 'desc');

        return $repo->paginate($request->limit);
    }
}
