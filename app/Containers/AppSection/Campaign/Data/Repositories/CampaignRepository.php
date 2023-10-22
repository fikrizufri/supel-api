<?php

namespace App\Containers\AppSection\Campaign\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;
use Illuminate\Support\Facades\DB;

class CampaignRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name' => 'like',
        // ...
    ];

    public function getColors($campaignId)
    {
        $where = " ";
        if($campaignId) {
            $where = " WHERE color NOT IN (
                  select warna from campaigns where subgroup_campaign_id=$campaignId
                )";
        }

        return DB::select("SELECT id, color FROM campaign_colors $where");
    }
}
