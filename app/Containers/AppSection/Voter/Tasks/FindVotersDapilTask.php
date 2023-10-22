<?php

namespace App\Containers\AppSection\Voter\Tasks;

use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Models\TimsesCampaign;
use App\Containers\AppSection\Voter\Data\Repositories\VoterRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;

class FindVotersDapilTask extends ParentTask
{
    public function __construct(
        protected VoterRepository $repository
    ) {
    }


    public function run($request): mixed
    {
        $kodeProvinsi = $request->get('kode_provinsi');
        $kodeKabupaten = $request->get('kode_kabupaten');
        $kodeKecamatan = $request->get('kode_kecamatan');
        $kodeDesa = $request->get('kode_desa');
        $cari = $request->get('cari');

        $repo = $this->repository->select([
            'id',
            'nkk',
            'nik',
            'name',
            'tempat_lahir',
            'tanggal_lahir',
            'umur',
            'jenis_kelamin',
            'kode_provinsi',
            'kode_kabupaten',
            'kode_kecamatan',
            'kode_desa',
            'alamat',
            'tps as kode_tps'
        ]);

        if ($kodeProvinsi != null) {
            $repo = $repo->where('kode_provinsi', $kodeProvinsi);
        }

        if ($kodeKabupaten != null) {
            $repo = $repo->where('kode_kabupaten', $kodeKabupaten);
        }

        if ($kodeKecamatan != null) {
            $repo = $repo->where('kode_kecamatan', $kodeKecamatan);
        }

        if ($kodeDesa != null) {
            $repo = $repo->where('kode_desa', $kodeDesa);
        }

        if ($cari != null) {
            $repo = $repo->where('name', 'LIKE', '%' . $cari . '%');
        }

        $user = $request->user();

        $timses = Timses::whereUserId($user->id)->first();

        if (!$timses) {
            throw new NotFoundException('Belum terdaftar sebagai timses.');
        }

        $campaign = Campaign::where('id_akun', $timses->default_campaign_id)->select('subgroup_campaign_id', 'kode_dapil', 'kode_kabupaten')->first();

        if (!$campaign) {
            throw new NotFoundException('Belum terdaftar sebagai timses kandidat.');
        }

        $timsesCampaign = TimsesCampaign::where('timses_id', $timses->id)->where('campaign_id', $timses->default_campaign_id)->first();

        if (!$timsesCampaign) {
            throw new NotFoundException('Anda belum terdaftar sebagai timses kandidat tersebut.');
        }

        if ($timsesCampaign->status === 'unapproved') {
            throw new NotFoundException('Akun timses anda belum di approved oleh kandidat.');
        }

        if ((int)$campaign->subgroup_campaign_id == 6) {
            $repo = $repo->whereIn('kode_kecamatan', function ($query) use ($campaign) {
                $query->from('dapil_wilayah')->where('dapil_id', $campaign->kode_dapil)->select('kode_kecamatan')->get();
            });
        }

        if ((int)$campaign->subgroup_campaign_id == 2) {
            $repo = $repo->where('kode_kabupaten', $campaign->kode_kabupaten);
        }

        if (in_array((int)$campaign->subgroup_campaign_id, [3, 5])) {
            $repo = $repo->whereIn('kode_kabupaten', function ($query) use ($campaign) {
                $query->from('dapil_wilayah')->where('dapil_id', $campaign->kode_dapil)->select('kode_kabupaten')->get();
            });
        }

        return $repo->limit(200)->get();
    }
}
