<?php

namespace App\Containers\AppSection\Campaign\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;
use Illuminate\Support\Facades\DB;

class VotersCampaignRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [

    ];

    public function kabupaten($timsesId, $subGroupId)
    {
        $query = "SELECT
                    s.id,
                    s.kode as kode_kabupaten,
                    s.nama as kabupaten
                    FROM wilayah s WHERE s.kode IN (
                    select DISTINCT v.kode_kabupaten from voters_campaign vc
                    inner join voters v on vc.voters_id = v.id
                    where vc.timses_id = $timsesId and vc.subgroup_campaign_id = $subGroupId
                    )";

        return DB::select($query);
    }

    public function kecamatan($timsesId, $subGroupId)
    {
        $query = "SELECT
                    s.id,
                    LEFT(s.kode, 5) as kode_kabupaten,
                    (SELECT t.nama FROM wilayah t WHERE t.kode=LEFT(s.kode, 5) LIMIT 1) as kabupaten,
                    s.kode as kode_kecamatan,
                    s.nama as kecamatan
                    FROM wilayah s WHERE s.kode IN (
                    select DISTINCT v.kode_kecamatan from voters_campaign vc
                    inner join voters v on vc.voters_id = v.id
                    where vc.timses_id = $timsesId and vc.subgroup_campaign_id = $subGroupId
                    )";

        return DB::select($query);
    }

    public function kelurahan($timsesId, $subGroupId)
    {
        $query = "SELECT
                    s.id,
                    s.kode as kode_kelurahan,
                    s.nama as kelurahan
                    FROM wilayah s WHERE s.kode IN (
                    select DISTINCT v.kode_desa from voters_campaign vc
                    inner join voters v on vc.voters_id = v.id
                    where vc.timses_id = $timsesId and vc.subgroup_campaign_id = $subGroupId
                    )";

        return DB::select($query);
    }

    public function campaignName($timsesId, $subGroupId)
    {
        $query = "select
                    DISTINCT vc.campaign_id,
                    (SELECT t.name FROM campaigns t WHERE t.id=vc.campaign_id LIMIT 1) as campaign_name
                    from voters_campaign vc
                    where vc.timses_id = $timsesId and vc.subgroup_campaign_id = $subGroupId";

        $data = DB::select($query);

        $dataCampaign = array();
        if (!empty($data)) {
            $campaignDefault = new \stdClass();
            $campaignDefault->campaign_id = 0;
            $campaignDefault->campaign_name = "Tampilkan semua";

            array_push($dataCampaign, $campaignDefault);

            foreach ($data as $campaign) {
                array_push($dataCampaign, $campaign);
            }
        }
        return $dataCampaign;
    }

    public function getVoterTps($timsesId, $subGroupId)
    {
        $query = "select
                    DISTINCT v.tps
                    from voters_campaign vc
                    inner join voters v on vc.voters_id = v.id
                    where vc.timses_id = $timsesId and vc.subgroup_campaign_id = $subGroupId";

        return DB::select($query);
    }
}
