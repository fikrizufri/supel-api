<?php

namespace App\Containers\AppSection\Timses\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;
use Illuminate\Support\Facades\DB;

class TimsesCampaignRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nomer_tps' => '=',
    ];

    public function getTimsesCampaign($timsesId){

        return $this->model()->join('campaigns', 'timses_campaign.campaign_id', '=', 'campaigns.id_akun')
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
