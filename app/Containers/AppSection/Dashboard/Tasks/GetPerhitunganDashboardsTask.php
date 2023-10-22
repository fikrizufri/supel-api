<?php

namespace App\Containers\AppSection\Dashboard\Tasks;

use App\Containers\AppSection\Dashboard\Data\Repositories\DashboardRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;

class GetPerhitunganDashboardsTask extends ParentTask
{
    public function __construct(
        protected DashboardRepository $repository
    ) {
    }

    public function run($subGroupId, $dapilId, $kabupaten)
    {
        return $this->repository->getPerhitungan($subGroupId, $dapilId, $kabupaten);
    }
}