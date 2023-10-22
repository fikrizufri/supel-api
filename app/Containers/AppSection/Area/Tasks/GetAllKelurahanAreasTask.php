<?php

namespace App\Containers\AppSection\Area\Tasks;

use App\Containers\AppSection\Area\Data\Repositories\AreaRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;

class GetAllKelurahanAreasTask extends ParentTask
{
    public function __construct(
        protected AreaRepository $repository
    ) {
    }


    public function run($request): mixed
    {
        return $this->repository->kelurahan($request->kecamatan, $request->search);
    }
}
