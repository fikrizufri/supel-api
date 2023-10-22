<?php

namespace App\Containers\AppSection\Banner\UI\API\Transformers;

use App\Containers\AppSection\Banner\Models\Banner;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class BannerTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Banner $banner): array
    {
        $response = [
            'object' => $banner->getResourceKey(),
            'id' => $banner->getHashedKey(),
            'image' => $banner->image,
            'ordering' => (int)$banner->ordering,
            'active' => $banner->active
        ];

        return $this->ifAdmin([
            'real_id' => $banner->id,
            'created_at' => $banner->created_at,
            'updated_at' => $banner->updated_at,
            'readable_created_at' => $banner->created_at->diffForHumans(),
            'readable_updated_at' => $banner->updated_at->diffForHumans(),
        ], $response);
    }
}
