<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Containers\AppSection\Authorization\Models\Role;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Str;

class FindRoleTask extends ParentTask
{
    public function __construct(
        protected RoleRepository $repository
    ) {
    }

    /**
     * @param string|int $roleNameOrId
     * @param string $guardName
     * @return Role
     * @throws NotFoundException
     */
    public function run(string|int $roleNameOrId, string $guardName = 'api'): Role
    {
        $query = [
            'guard_name' => $guardName,
            'name' => $roleNameOrId,
        ];

        $role = $this->repository->findWhere($query)->first();

        return $role ?? throw new NotFoundException();
    }

    /**
     * @param int|string $roleNameOrId
     * @return bool
     */
    private function isID(int|string $roleNameOrId): bool
    {
        return (is_numeric($roleNameOrId) || Str::isUuid($roleNameOrId));
    }
}
