<?php

namespace App\Containers\AppSection\Partai\UI\API\Transformers;

use App\Containers\AppSection\Partai\Models\Partai;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class PartaiPublicTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Partai $partai): array
    {
        return [
            'id' => $partai->getHashedKey(),
            'nomer_urut' => (int)$partai->nomer_urut,
            'simbol' => $partai->simbol,
        ];

    }
}
