<?php

namespace App\Containers\AppSection\Campaign\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class SubGroupCampaign extends ParentModel
{
    protected $table = 'subgroup_campaigns';
    protected $fillable = [
        'group_campaign_id',
        'kode',
        'name'
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'GroupCampaign';

    public function group()
    {
        return $this->hasOne(GroupCampaign::class, 'id', 'group_campaign_id');
    }
}
