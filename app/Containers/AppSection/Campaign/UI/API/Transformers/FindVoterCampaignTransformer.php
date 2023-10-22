<?php

namespace App\Containers\AppSection\Campaign\UI\API\Transformers;

use App\Containers\AppSection\Campaign\Models\VotersCampaign;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class FindVoterCampaignTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(VotersCampaign $votersCampaign): array
    {

        return [
            'object'        => $votersCampaign->getResourceKey(),
            'id'            => $votersCampaign->id,
            'campaign_id'   => $votersCampaign->campaign_id,
            'partai_id'     => $votersCampaign->partai_id,
            'timses_id'     => $votersCampaign->timses_id,
            'voters_id'     => $votersCampaign->voters_id,
            'status'        => $votersCampaign->status,
            'info'          => $votersCampaign->info,
            'campaign'      => $votersCampaign->campaign()->first(),
            'voter'         => $votersCampaign->voter()->first(),
            'partai'         => $votersCampaign->partai()->first(),
        ];
    }
}
