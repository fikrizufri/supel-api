<?php

namespace App\Containers\AppSection\Capres\UI\API\Transformers;

use App\Containers\AppSection\Capres\Models\Capres;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class CapresTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Capres $capres): array
    {
        $response = [
            'object' => $capres->getResourceKey(),
            'id' => $capres->getHashedKey(),
            'nama_pasangan' => $capres->nama_pasangan,
            'img' => $capres->img,
            'description' => $capres->description
        ];

        return $this->ifAdmin([
            'real_id' => $capres->id,
            'created_at' => $capres->created_at,
            'updated_at' => $capres->updated_at,
            'readable_created_at' => $capres->created_at->diffForHumans(),
            'readable_updated_at' => $capres->updated_at->diffForHumans(),
            // 'deleted_at' => $capres->deleted_at,
        ], $response);
    }
}
