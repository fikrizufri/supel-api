<?php

namespace App\Containers\AppSection\Campaign\Data\Seeders;

use App\Containers\AppSection\Campaign\Models\GroupCampaign;
use App\Containers\AppSection\Campaign\Models\SubGroupCampaign;
use App\Ship\Parents\Seeders\Seeder as ParentSeeder;

class CampaignSeeder extends ParentSeeder
{
    public function run()
    {
        $data = [
            'Pilkada' => [
                'G' => 'Gubernur',
                'B' => 'Bupati',
            ],
            'Pileg' => [
                'DPR' => 'DPR RI',
                'DPD' => 'DPD',
                'DPRA' => 'DPR TK I / DPRA',
                'DPRK' => 'DPR TK II / DPRK',
            ]
        ];

        foreach ( $data as $group => $sub ){
            if(empty($sub)) continue;
            if(is_array($sub)){
                if(empty($group)) continue;
                $parent = GroupCampaign::create([
                    'name' => $group
                ]);
                foreach ( $sub as $kode => $name ){
                    if(empty($name)) continue;
                    SubGroupCampaign::create([
                        'group_campaign_id' => $parent->id ?: 0,
                        'kode' => $kode,
                        'name' => $name
                    ]);
                }
            } else {
                GroupCampaign::create([
                    'name' => $group
                ]);
            }
        }
    }
}
