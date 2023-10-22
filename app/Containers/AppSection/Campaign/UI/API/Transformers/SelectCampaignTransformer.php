<?php

namespace App\Containers\AppSection\Campaign\UI\API\Transformers;

use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class SelectCampaignTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Campaign $campaign): array
    {
        return [
            'object' => $campaign->getResourceKey(),
            'real_id' => $campaign->id,
            'id_akun' => $campaign->id_akun,
            'name' => $campaign->name,
            'nomor_urut' => $campaign->nomor_urut,
            'kode_partai' => $campaign->kode_partai,
        ];
    }
}
