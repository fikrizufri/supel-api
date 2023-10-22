<?php

namespace App\Containers\AppSection\Campaign\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class DapilCampaign extends ParentModel
{
    protected $table = 'dapil';
    protected $fillable = [
        'subgroup',
        'kode_provinsi',
        'nama_provinsi',
        'name'
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'DapilCampaign';
}
