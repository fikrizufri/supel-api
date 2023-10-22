<?php

namespace App\Containers\AppSection\Timses\UI\API\Transformers;

use App\Containers\AppSection\Timses\Models\TimsesCampaign;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class TimsesCampaignListTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(TimsesCampaign $timses): array
    {
        return [
            'object' => $timses->getResourceKey(),
            'campaign_id' => $timses->campaign_id,
            'name' =>$timses->name,
            'image' =>$timses->image,
            'pemilihan' =>$timses->pemilihan,
            'kabupaten' =>$timses->kabupaten,
            'dapil' =>$timses->dapil,
            'defaultCampaign' =>$timses->defaultCampaign,
        ];
    }
}
