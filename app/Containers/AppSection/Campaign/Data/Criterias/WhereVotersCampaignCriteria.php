<?php

namespace App\Containers\AppSection\Campaign\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class WhereVotersCampaignCriteria extends Criteria
{
    protected int $campaignId;

    public function __construct($campaignId){
        $this->campaignId = $campaignId;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('campaign_id', '=',$this->campaignId);
    }
}
