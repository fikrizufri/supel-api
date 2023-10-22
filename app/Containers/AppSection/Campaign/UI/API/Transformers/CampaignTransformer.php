<?php

namespace App\Containers\AppSection\Campaign\UI\API\Transformers;

use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Ship\Parents\Transformers\Transformer as ParentTransformer;

class CampaignTransformer extends ParentTransformer
{
    protected array $defaultIncludes = [

    ];

    protected array $availableIncludes = [

    ];

    public function transform(Campaign $campaign): array
    {
        $response = [
            'object' => $campaign->getResourceKey(),
            'id' => $campaign->getHashedKey(),
            'real_id' => $campaign->id,
            'id_akun' => $campaign->id_akun,
            'group_campaign_id' => $campaign->group_campaign_id,
            'group_campaign_name' => get_group_name($campaign->group_campaign_id),
            'subgroup_campaign_id' => $campaign->subgroup_campaign_id,
            'name_subgroup_campaign' => get_subgroup_name($campaign->subgroup_campaign_id),
            'kode_subgroup_campaign' => get_subgroup_kode($campaign->subgroup_campaign_id),
            'kode_partai' => $campaign->kode_partai,
            'nama_partai' => get_partai_name($campaign->kode_partai),
            'kode_dapil' => $campaign->kode_dapil,
            'nama_dapil' => get_dapil_name($campaign->kode_dapil),
            'kode_kabupaten' => $campaign->kode_kabupaten,
            'nama_kabupaten' => $campaign->kode_kabupaten != null ? get_nama_wilayah($campaign->kode_kabupaten) : null,
            'kode_provinsi' => $campaign->kode_provinsi,
            'nama_provinsi' => $campaign->kode_provinsi != null ? get_nama_wilayah($campaign->kode_provinsi) : null,
            'name' => $campaign->name,
            'singkatan' => $campaign->singkatan,
            'slogan' => $campaign->slogan,
            'warna' => $campaign->warna,
            'campaign' => (int)$campaign->campaign,
            'survey' => (int)$campaign->survey,
            'count' => (int)$campaign->count,
            'active' => (int)$campaign->active,
            'image' => $campaign->image
        ];

        return $this->ifAdmin([
            'created_at' => $campaign->created_at,
            'updated_at' => $campaign->updated_at,
            'readable_created_at' => $campaign->created_at->diffForHumans(),
            'readable_updated_at' => $campaign->updated_at->diffForHumans(),
        ], $response);
    }
}
