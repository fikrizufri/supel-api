<?php

namespace App\Containers\AppSection\Area\Tasks;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Area\Data\Repositories\AreaRepository;
use App\Containers\AppSection\Area\Events\AreasListedEvent;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllKabupatenDapilTask extends ParentTask
{
    public function __construct(
        protected AreaRepository $repository
    ) {
    }


    public function run($campaign): mixed
    {
        $subGroup = $campaign->subgroup_campaign_id;
        $kabupatenId = $campaign->kode_kabupaten;
        $dapilId = $campaign->kode_dapil;

        return $this->repository->kabupatenDapil($subGroup, $kabupatenId, $dapilId);
    }
}