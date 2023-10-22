<?php

namespace App\Containers\AppSection\Simpatisan\UI\API\Transformers;

use App\Containers\AppSection\Simpatisan\Models\Simpatisan;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class SimpatisanTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Simpatisan $simpatisan): array
    {
        $response = [
            'object' => $simpatisan->getResourceKey(),
            'id' => $simpatisan->getHashedKey(),
            'nik' => $simpatisan->nik,
            'name' => $simpatisan->name,
            'gender' => $simpatisan->gender,
            'place_of_birth' => $simpatisan->place_of_birth,
            'date_of_birth' => $simpatisan->date_of_birth,
            'address' => $simpatisan->address,
            'kode_province' => $simpatisan->kode_province,
            'kode_kabupaten' => $simpatisan->kode_kabupaten,
            'kode_kecamatan' => $simpatisan->kode_kecamatan,
            'nama_provinsi' => $simpatisan->kode_province != null ? get_nama_wilayah($simpatisan->kode_province) : null,
            'kode_desa' => $simpatisan->kode_desa,
            'religion' => $simpatisan->religion,
            'status_perkawinan' => $simpatisan->status_perkawinan,
            'pekerjaan' => $simpatisan->pekerjaan,
            'campaign_id' => $simpatisan->campaign_id,
        ];

        return $this->ifAdmin([
            'real_id' => $simpatisan->id,
            'created_at' => $simpatisan->created_at,
            'updated_at' => $simpatisan->updated_at,
            'readable_created_at' => $simpatisan->created_at->diffForHumans(),
            'readable_updated_at' => $simpatisan->updated_at->diffForHumans(),
            // 'deleted_at' => $simpatisan->deleted_at,
        ], $response);
    }
}
