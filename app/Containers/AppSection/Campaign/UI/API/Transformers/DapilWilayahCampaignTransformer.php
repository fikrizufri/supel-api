<?php

namespace App\Containers\AppSection\Campaign\UI\API\Transformers;

use App\Containers\AppSection\Campaign\Models\DapilWilayahCampaign;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class DapilWilayahCampaignTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(DapilWilayahCampaign $campaign): array
    {
        return [
            'id' => $campaign->id,
            'kode_kabupaten' => $campaign->kode_kabupaten,
            'kode_kecamatan' => $campaign->kode_kecamatan,
            'kabupaten' => $campaign->kode_kabupaten != null ?  get_nama_wilayah($campaign->kode_kabupaten) : null,
            'kecamatan' => $campaign->kode_kecamatan != null ?  get_nama_wilayah($campaign->kode_kecamatan) : null,
        ];
    }
}
