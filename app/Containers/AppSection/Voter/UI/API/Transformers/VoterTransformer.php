<?php

namespace App\Containers\AppSection\Voter\UI\API\Transformers;

use App\Containers\AppSection\Voter\Models\Voter;
use App\Containers\AppSection\Voter\Tasks\GetAllVotersDesaAreaTask;
use App\Containers\AppSection\Voter\Tasks\GetAllVotersKabupatenAreaTask;
use App\Containers\AppSection\Voter\Tasks\GetAllVotersKecamatanAreaTask;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class VoterTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Voter $voter): array
    {
        $response = [
            'object' => $voter->getResourceKey(),
            'id' => $voter->id,
            'data_id' => $voter->data_id,
            'nkk' => $voter->nkk,
            'nik' => $voter->nik,
            'name' => $voter->name,
            'umur' => $voter->umur,
            'tempat_lahir' => $voter->tempat_lahir,
            'tanggal_lahir' => $voter->tanggal_lahir,
            'kawin' => $voter->kawin,
            'jenis_kelamin' => $voter->jenis_kelamin,
            'alamat' => $voter->alamat,
            'rt' => $voter->rt,
            'rw' => $voter->rw,
            'umur' => $voter->umur,
            'difabel' => $voter->difabel,
            'tps' => $voter->tps,
            'group_id' => $voter->group_id,
            'group_name' => get_group_name($voter->group_name),
            'kode_desa' => $voter->kode_desa,
            'nama_desa' => $voter->kode_desa != null ? get_nama_wilayah($voter->kode_desa) : null,
            'kode_kecamatan' => $voter->kode_kecamatan,
            'nama_kecamatan' => $voter->kode_kecamatan != null ? get_nama_wilayah($voter->kode_kecamatan) : null,
            'kode_kabupaten' => $voter->kode_kabupaten,
            'nama_kabupaten' => $voter->kode_kabupaten != null ? get_nama_wilayah($voter->kode_kabupaten) : null,
            'kode_provinsi' => $voter->kode_provinsi,
            'nama_provinsi' => $voter->kode_provinsi != null ? get_nama_wilayah($voter->kode_provinsi) : null,
        ];

        return $response;
    }
}
