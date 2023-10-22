<?php

namespace App\Containers\AppSection\User\UI\API\Transformers;

use App\Containers\AppSection\Authorization\UI\API\Transformers\RoleTransformer;
use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;
use League\Fractal\Resource\Collection;

class UserTransformer extends ParentTransformer
{
    protected array $availableIncludes = [
        'roles',
    ];

    protected array $defaultIncludes = [

    ];

    public function transform(User $user): array
    {
        $roles = $user->roles()->first();
        $response = [
            'object' => $user->getResourceKey(),
            'real_id' => $user->id,
            'id' => $user->getHashedKey(),
            'group_id' => $user->group_id,
            'group_name' => get_group_kandidat_name($user->group_id),
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'email_verified_at' => $user->email_verified_at,
            'gender' => $user->gender,
            'birth' => $user->birth,
            'role_name' => $roles ? $roles->name : '',
            'role_display_name' => $roles ? $roles->display_name : '',
        ];

        return $this->ifAdmin([
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,
            'readable_created_at' => $user->created_at->diffForHumans(),
            'readable_updated_at' => $user->updated_at->diffForHumans(),
        ], $response);
    }

    public function includeRoles(User $user): Collection
    {
        return $this->collection($user->roles, new RoleTransformer());
    }
}
