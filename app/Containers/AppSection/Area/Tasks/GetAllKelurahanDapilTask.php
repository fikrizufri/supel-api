<?php

namespace App\Containers\AppSection\Area\Tasks;

use App\Containers\AppSection\Area\Data\Repositories\AreaRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;

class GetAllKelurahanDapilTask extends ParentTask
{
    public function __construct(
        protected AreaRepository $repository
    ) {
    }


    public function run($campaign, $kecamatan): mixed
    {
        $subGroup = $campaign->subgroup_campaign_id;
        $kabupatenId = $campaign->kode_kabupaten;
        $dapilId = $campaign->kode_dapil;

        return $this->repository->kelurahanDapil($subGroup, $kabupatenId, $dapilId, $kecamatan);
    }
}
