<?php

namespace App\Containers\AppSection\Campaign\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class Campaign extends ParentModel
{

    protected $table = 'campaigns';    
    protected $fillable = [
        'id_akun',
        'group_campaign_id',
        'subgroup_campaign_id',
        'kode_subgroup_campaign',
        'kode_provinsi',
        'kode_kabupaten',
        'kode_dapil',
        'kode_partai',
        'name',
        'singkatan',
        'slogan',
        'warna',
        'date_campaign',
        'campaign',
        'survey',
        'count',
        'image',
        'active'
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Campaign';
}
