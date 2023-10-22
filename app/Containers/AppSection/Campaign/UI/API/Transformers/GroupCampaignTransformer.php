<?php

namespace App\Containers\AppSection\Campaign\UI\API\Transformers;

use App\Containers\AppSection\Campaign\Models\GroupCampaign;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class GroupCampaignTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(GroupCampaign $campaign): array
    {
        $response = [
            'object' => $campaign->getResourceKey(),
            'id' => $campaign->id,
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
