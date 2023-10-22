<?php

namespace App\Containers\AppSection\Dashboard\Tasks;

use App\Containers\AppSection\Dashboard\Data\Repositories\AppVersionRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;

class GetVersionTask extends ParentTask
{
    public function __construct(
        protected AppVersionRepository $repository
    ) {
    }

    public function run()
    {
        return $this->repository->orderBy('version_code', 'desc')->first();
    }
}
