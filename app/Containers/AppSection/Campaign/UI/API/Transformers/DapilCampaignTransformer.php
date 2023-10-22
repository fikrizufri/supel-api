<?php

namespace App\Containers\AppSection\Campaign\UI\API\Transformers;

use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Campaign\Models\DapilCampaign;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class DapilCampaignTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(DapilCampaign $campaign): array
    {
        $response = [
            'object' => $campaign->getResourceKey(),
            'id' => $campaign->getHashedKey(),
            'real_id' => $campaign->id,
            'subgroup' => $campaign->subgroup,
            'kode_provinsi' => $campaign->kode_provinsi,
            'nama_provinsi' => $campaign->nama_provinsi,
            'name' => $campaign->name,
        ];

        return $this->ifAdmin([
            'created_at' => $campaign->created_at,
            'updated_at' => $campaign->updated_at,
            'readable_created_at' => $campaign->created_at->diffForHumans(),
            'readable_updated_at' => $campaign->updated_at->diffForHumans(),
        ], $response);
    }
}
