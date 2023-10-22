<?php

namespace App\Containers\AppSection\Voter\Tasks;

use App\Containers\AppSection\Campaign\Models\DapilCampaign;
use App\Containers\AppSection\Voter\Data\Repositories\VoterRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Facades\DB;

class FindVotersTask extends ParentTask
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

        return $repo->limit(100)->get();
    }
}
