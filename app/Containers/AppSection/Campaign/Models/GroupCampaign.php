<?php

namespace App\Containers\AppSection\Campaign\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class GroupCampaign extends ParentModel
{
    protected $table = 'group_campaigns';
    protected $fillable = [
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
}
