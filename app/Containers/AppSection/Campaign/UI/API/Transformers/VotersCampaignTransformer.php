<?php

namespace App\Containers\AppSection\Campaign\UI\API\Transformers;

use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Campaign\Models\VotersCampaign;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class VotersCampaignTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(VotersCampaign $campaign): array
    {
        return [
            'object' => $campaign->getResourceKey(),
            'id' => $campaign->getHashedKey(),
            'real_id' => $campaign->id,
            'campaign_id' => $campaign->campaign_id,
            'timses_id' => $campaign->timses_id,
            'voters_id' => $campaign->voters_id,
            'status' => $campaign->status,
        ];
    }
}
