<?php

namespace App\Containers\AppSection\Timses\UI\API\Transformers;

use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class TimsesTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Timses $timses): array
    {
        return [
            'object' => $timses->getResourceKey(),
            'default_campaign_id' => $timses->default_campaign_id,
            'id' => $timses->getHashedKey(),
            'real_id' => $timses->id,
            'user_id' =>$timses->user_id,
            'group_id' => $timses->group_id,
            'group_name' => get_group_kandidat_name($timses->group_id),
            'name' =>$timses->name,
            'nick_name' =>$timses->nick_name,
            'phone' =>$timses->phone,
            'nik' =>$timses->nik,
            'campaign_id' => $timses->campaign_id,
            'status' => $timses->status,
            'saksi' => $timses->saksi,
            'nomer_tps' => $timses->nomer_tps,
            'id_timses_recommend' => $timses->id_timses_recommend,
            'timses_campaign_id' => $timses->timses_campaign_id,
            'kandidat' => $timses->kandidat,
            'created_at' => $timses->created_at->format('d-F-Y'),
            'updated_at' => $timses->updated_at,
        ];
    }
}
