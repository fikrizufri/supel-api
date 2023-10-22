<?php

namespace App\Containers\AppSection\Campaign\UI\API\Transformers;

use App\Containers\AppSection\Campaign\Models\SubGroupCampaign;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class SubGroupCampaignTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(SubGroupCampaign $campaign): array
    {
        $response = [
            'object' => $campaign->getResourceKey(),
            'id' => $campaign->id,
            'kode' => $campaign->kode,
            'name' => $campaign->name,
            'group' => $campaign->group()->first(),
        ];

        return $this->ifAdmin([
            'created_at' => $campaign->created_at,
            'updated_at' => $campaign->updated_at,
            'readable_created_at' => $campaign->created_at->diffForHumans(),
            'readable_updated_at' => $campaign->updated_at->diffForHumans(),
        ], $response);
    }
}
