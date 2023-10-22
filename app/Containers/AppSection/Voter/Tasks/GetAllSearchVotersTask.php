<?php

namespace App\Containers\AppSection\Voter\Tasks;

use App\Containers\AppSection\Campaign\Models\DapilCampaign;
use App\Containers\AppSection\Voter\Data\Repositories\VoterRepository;
use App\Containers\AppSection\Voter\Data\Criterias\SelectCriteria;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Facades\DB;

class GetAllSearchVotersTask extends ParentTask
{
    public function __construct(
        protected VoterRepository $repository
    ) {
    }


    public function run($request, $campaign): mixed
    {
        $subGroup = $campaign->subgroup_campaign_id;
        $kabupatenId = $campaign->kode_kabupaten;
        $dapilId = $campaign->kode_dapil;

        $whereDapilKabupaten = null;
        $whereDapilKecamatan = null;

        if (in_array((int)$subGroup, [3, 5, 6])) {
            $dapil = DapilCampaign::whereId($dapilId)->first();

            if ($dapil) {
                $whereDapilKabupaten = collect(DB::select("SELECT kode_kabupaten FROM dapil_wilayah WHERE dapil_id=$dapilId"))->pluck('kode_kabupaten')->toArray();
                $whereDapilKecamatan = null;
                if ($dapil->subgroup == 'DPRK') {
                    $whereDapilKabupaten = null;
                    $whereDapilKecamatan = collect(DB::select("SELECT kode_kecamatan FROM dapil_wilayah WHERE dapil_id=$dapilId"))->pluck('kode_kecamatan')->toArray();
                }
            }
        }

        $kodeKabupaten = $request->get('kodeKabupaten');
        $kodeKecamatan = $request->get('kodeKecamatan');
        $kodeDesa = $request->get('kodeDesa');
        $cari = $request->get('cari');

        $repo = $this->repository->select([
            'id',
            'nkk',
            'nik',
            'name',
            'jenis_kelamin',
            'umur',
            'rt',
            'rw',
            'tempat_lahir',
            'tanggal_lahir',
            'kode_provinsi',
            'kode_kabupaten',
            'kode_kecamatan',
            'kode_desa',
            'tps as kode_tps'
        ]);

        if ($whereDapilKabupaten != null && $kodeKabupaten == null) {
            $repo = $repo->whereIn('kode_kabupaten', $whereDapilKabupaten);
        }

        if ($whereDapilKecamatan != null && $kodeKecamatan == null) {
            $repo = $repo->whereIn('kode_kecamatan', $whereDapilKecamatan);
        }

        if ((int)$subGroup == 2) {
            $repo = $repo->where('kode_kabupaten', $kabupatenId);
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
            $repo = $repo->where('name', 'LIKE', $cari . '%')->orWhere('nkk', 'LIKE', $cari . '%')->orWhere('nik', 'LIKE', $cari . '%');
        }

        return $repo->limit(100)->get();
    }
}
