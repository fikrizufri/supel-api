<?php

namespace App\Containers\AppSection\Campaign\Data\Repositories;

use App\Ship\Parents\Repositories\Repository as ParentRepository;
use Illuminate\Support\Facades\DB;

class SubGroupCampaignRepository extends ParentRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'id' => '=',
        // ...
    ];
                public function search($value)
    {
        $query = "SELECT name FROM campaigns WHERE kode_subgroup_campaign LIKE '$value%' LIMIT 1000";
        return DB::select($query);
    }
         public function partai($value)
    {
        $query = "SELECT p.name FROM partai p WHERE p.name LIKE '$value%' LIMIT 1000";
        return DB::select($query);
    }

         public function pileg($partai, $value)
    {

        $wherePartai = '';

        if(!is_null($partai)) {
            $wherePartai = " AND p.name LIKE '$partai%'";
        }
        $query = "SELECT c.name FROM campaigns c INNER JOIN partai p ON c.kode_partai = p.id WHERE kode_subgroup_campaign LIKE '$value%' $wherePartai LIMIT 1000";
        return DB::select($query);
    }
}
