<?php

namespace App\Containers\AppSection\Voter\UI\API\Transformers;

use App\Containers\AppSection\Voter\Models\Voter;
use App\Containers\AppSection\Voter\Tasks\GetAllVotersDesaAreaTask;
use App\Containers\AppSection\Voter\Tasks\GetAllVotersKabupatenAreaTask;
use App\Containers\AppSection\Voter\Tasks\GetAllVotersKecamatanAreaTask;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class VoterSearchTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Voter $voter): array
    {
        return [
            'id' => $voter->id,
            'nik' => $voter->nik,
            'name' => $voter->name,
            'jenis_kelamin' => $voter->jenis_kelamin,
            'tempat_lahir' => $voter->tempat_lahir,
            'tanggal_lahir' => $voter->tanggal_lahir,
            'umur' => $voter->umur,
            'rt' => $voter->rt,
            'rw' => $voter->rw,
            'kode_tps' => $voter->kode_tps,
            'nama_desa' => $voter->kode_desa != null ? get_nama_wilayah($voter->kode_desa) : null,
            'nama_kecamatan' => $voter->kode_kecamatan != null ? get_nama_wilayah($voter->kode_kecamatan) : null,
            'nama_kabupaten' => $voter->kode_kabupaten != null ? get_nama_wilayah($voter->kode_kabupaten) : null,
            'nama_provinsi' => $voter->kode_provinsi != null ? get_nama_wilayah($voter->kode_provinsi) : null,
        ];
    }
}
