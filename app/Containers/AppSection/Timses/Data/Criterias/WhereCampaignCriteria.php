<?php

namespace App\Containers\AppSection\Timses\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class WhereCampaignCriteria extends Criteria
{
    protected string $campaignCode;

    public function __construct($campaignCode)
    {
        $this->campaignCode = $campaignCode;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('timses_campaign.campaign_id', $this->campaignCode);
    }
}
