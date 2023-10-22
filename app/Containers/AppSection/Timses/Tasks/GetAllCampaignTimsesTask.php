<?php

namespace App\Containers\AppSection\Timses\Tasks;


use App\Containers\AppSection\Timses\Data\Repositories\TimsesCampaignRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;
use Illuminate\Support\Facades\DB;

class GetAllCampaignTimsesTask extends ParentTask
{
    public function __construct(
        protected TimsesCampaignRepository $repository
    )
    {
    }


    public function run($timsesId): mixed
    {
        return $this->repository->join('campaigns', 'timses_campaign.campaign_id', '=', 'campaigns.id_akun')
            ->where('timses_campaign.timses_id', $timsesId)
            ->select([
                'timses_campaign.campaign_id',
                'campaigns.name',
                'campaigns.image',
                DB::raw('(select j.name from subgroup_campaigns j where j.id=campaigns.subgroup_campaign_id limit 1) as pemilihan'),
                DB::raw('(select j.nama from wilayah j where j.kode=campaigns.kode_kabupaten limit 1) as kabupaten'),
                DB::raw('(select j.name from dapil j where j.id=campaigns.kode_dapil limit 1) as dapil'),
                DB::raw('CASE WHEN timses_campaign.campaign_id = (select j.default_campaign_id from timses j where j.id='.$timsesId.' limit 1) THEN true ELSE false END as defaultCampaign'),
            ])->get();
    }
}
