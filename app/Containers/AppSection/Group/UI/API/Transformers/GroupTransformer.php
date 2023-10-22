<?php

namespace App\Containers\AppSection\Group\UI\API\Transformers;

use App\Containers\AppSection\Group\Models\Group;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class GroupTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Group $group): array
    {
        return  [
            'object' => $group->getResourceKey(),
            'id' => $group->id,
            'group_name' => $group->group_name,
        ];

    }
}
