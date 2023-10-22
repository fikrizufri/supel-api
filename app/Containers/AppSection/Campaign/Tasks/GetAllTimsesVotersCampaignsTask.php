<?php

namespace App\Containers\AppSection\Campaign\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Campaign\Data\Repositories\VotersCampaignRepository;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Models\TimsesCampaign;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllTimsesVotersCampaignsTask extends ParentTask
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

        $repo = $this->repository->join('campaigns', 'voters_campaign.campaign_id', '=', 'campaigns.id')
            ->join('voters', 'voters_campaign.voters_id', '=', 'voters.id');

        if ($user) {
            $timses = Timses::where('user_id', $user->id)->first();
            $campaign =  Campaign::whereIdAkun($timses->default_campaign_id)->select('id', 'subgroup_campaign_id')->first();

            if (!$timses) {
                throw new NotFoundException('Data timses tidak ditemukan.');
            }

            if (!$campaign) {
                throw new NotFoundException('Belum terdapat di kandidat tersebut.');
            }

            $timsesCampaign = TimsesCampaign::where('timses_id', $timses->id)->where('campaign_id', $timses->default_campaign_id)->first();

            if (!$timsesCampaign) {
                throw new NotFoundException('Anda belum terdaftar sebagai timses kandidat tersebut.');
            }

            $repo = $repo->where('voters_campaign.timses_id', '=', $timses->id)->where('voters_campaign.subgroup_campaign_id', $campaign->subgroup_campaign_id);

        }

        if ($request->search) {
            $repo = $repo->where('voters.name', 'like', '%' . $request->search . '%')
                ->orWhere('voters.tempat_lahir', 'like', '%' . $request->search . '%');
        }

        if ($request->status && $request->status != 'Tampilkan semua') {
            $repo = $repo->where('voters_campaign.status', '=', $request->status);
        }

        if ($request->kodeProvinsi) {
            $repo = $repo->where('voters.kode_provinsi', '=', $request->kodeProvinsi);
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
