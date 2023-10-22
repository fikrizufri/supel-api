<?php

namespace App\Containers\AppSection\Timses\UI\API\Transformers;

use App\Containers\AppSection\Timses\Models\TimsesCampaign;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class TimsesCampaignTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(TimsesCampaign $timsesCampaign): array
    {
        $response = [
            'object' => $timsesCampaign->getResourceKey(),
            'id' => $timsesCampaign->getHashedKey(),
            'timses_id' =>$timsesCampaign->timses_id,
            'campaign_id' =>$timsesCampaign->campaign_id,
            'nomer_tps' =>$timsesCampaign->nomer_tps,
            'status' =>$timsesCampaign->status,
            'saksi' =>$timsesCampaign->saksi,
            'created_at' => $timsesCampaign->created_at->format('d-F-Y'),
        ];

        return $this->ifAdmin([
            'real_id' => $timsesCampaign->id,
            'updated_at' => $timsesCampaign->updated_at,
            'readable_created_at' => $timsesCampaign->created_at->diffForHumans(),
            'readable_updated_at' => $timsesCampaign->updated_at->diffForHumans(),
        ], $response);
    }
}
