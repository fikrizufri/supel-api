<?php

namespace App\Containers\AppSection\Area\UI\API\Transformers;

use App\Containers\AppSection\Area\Models\Area;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class AreaTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Area $area): array
    {
        return [
            'kode_kabupaten' => $area->kode_kabupaten,
            'kode_kecamatan' => $area->kode_kecamatan,
        ];
    }
}
