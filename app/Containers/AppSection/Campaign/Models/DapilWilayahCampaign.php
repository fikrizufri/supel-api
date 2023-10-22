<?php

namespace App\Containers\AppSection\Campaign\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class DapilWilayahCampaign extends ParentModel
{
    protected $table = 'dapil_wilayah';
    protected $fillable = [
        'dapil_id',
        'kode_kabupaten',
        'kode_kecamatan',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'DapilWilayahCampaign';

    public function dapil()
    {
        return $this->hasOne(DapilCampaign::class, 'id', 'dapil_id');
    }

}
