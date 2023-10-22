<?php

namespace App\Containers\AppSection\Dashboard\UI\API\Transformers;

use App\Containers\AppSection\Dashboard\Models\Appversion;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class AppversionTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Appversion $version): array
    {
        return [
            'object' => $version->getResourceKey(),
            'id' => $version->id,
            'version_code' => $version->version_code,
            'version_name' => $version->version_name,
            'date_submit' => $version->date_submit,
        ];
    }
}
