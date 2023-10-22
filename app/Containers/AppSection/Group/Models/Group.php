<?php

namespace App\Containers\AppSection\Group\Models;

use App\Ship\Parents\Models\Model as ParentModel;

class Group extends ParentModel
{
     protected $table = 'groups';
    protected $fillable = [
        'group_name',
        'campaign_id',
    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Group';
}
