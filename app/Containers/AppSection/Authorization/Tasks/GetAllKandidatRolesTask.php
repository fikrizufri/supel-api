<?php

namespace App\Containers\AppSection\Authorization\Tasks;

use App\Containers\AppSection\Authorization\Data\Repositories\RoleRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;

class GetAllKandidatRolesTask extends ParentTask
{
    public function __construct(
        protected RoleRepository $repository
    ) {
    }

    public function run(): mixed
    {
        $repository = $this->addRequestCriteria()->repository;
        return $repository->findWhereIn('name', ['adminkandidat', 'adminpartai', 'admin']);
    }
}
