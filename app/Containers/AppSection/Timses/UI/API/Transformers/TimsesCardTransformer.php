<?php

namespace App\Containers\AppSection\Timses\UI\API\Transformers;

use App\Containers\AppSection\Timses\Models\TimsesCampaign;
use App\Containers\AppSection\Timses\Models\TimsesCard;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class TimsesCardTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(TimsesCard $timsesCard): array
    {
        $response = [
            'object' => $timsesCard->getResourceKey(),
            'timses_id' => $timsesCard->timses_id,
            'name' => $timsesCard->name,
            'id_card' => $timsesCard->id_card,
            'kode_province' => $timsesCard->kode_province,
            'kode_kabupaten' => $timsesCard->kode_kabupaten,
            'kode_kecamatan' => $timsesCard->kode_kecamatan,
            'kode_desa' => $timsesCard->kode_desa,
            'photo' => $timsesCard->photo,
            'nama_organisasi' => $timsesCard->nama_organisasi,
            'slogan_organisasi' => $timsesCard->slogan_organisasi,
            'logo_organisasi' => $timsesCard->logo_organisasi,
            'alamat_organisasi' => $timsesCard->alamat_organisasi,
            'tanggal_berlaku' => $timsesCard->tanggal_berlaku,
            'email_organisasi' => $timsesCard->email_organisasi,
            'telephone_organisasi' => $timsesCard->telephone_organisasi,
            'image_generate' => $timsesCard->image_generate,
            'warna' => $timsesCard->warna,
        ];

        return $this->ifAdmin([
            'real_id' => $timsesCard->id,
            'updated_at' => $timsesCard->updated_at,
            'readable_created_at' => $timsesCard->created_at->diffForHumans(),
            'readable_updated_at' => $timsesCard->updated_at->diffForHumans(),
        ], $response);
    }
}
