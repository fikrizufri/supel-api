<?php

namespace App\Containers\AppSection\Timses\UI\API\Transformers;

use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class TimsesCampaignSelectTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Timses $timses): array
    {
        return [
            'object' => $timses->getResourceKey(),
            'id' => $timses->id,
            'name' =>$timses->name,
        ];
    }
}
