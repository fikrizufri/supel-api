<?php

namespace App\Containers\AppSection\Simpatisan\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class WhereCampaignIdCriteria extends Criteria
{
    protected string $campaignId;

    public function __construct($campaignId)
    {
        $this->campaignId = $campaignId;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('campaign_id', $this->campaignId);
    }
}
