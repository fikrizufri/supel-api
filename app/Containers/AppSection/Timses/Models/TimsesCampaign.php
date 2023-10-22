<?php

namespace App\Containers\AppSection\Timses\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class TimsesCampaign extends ParentModel
{
    protected $table = 'timses_campaign';

    protected $fillable = [
        'campaign_id',
        'timses_id',
        'status',
        'saksi',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'TimsesCampaign';
}
