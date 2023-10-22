<?php

namespace App\Containers\AppSection\Article\Data\Criterias;

use App\Ship\Parents\Criterias\Criteria;
use Prettus\Repository\Contracts\RepositoryInterface as PrettusRepositoryInterface;

class CampaignCriteria extends Criteria
{
    protected string $campaign;

    public function __construct($campaign)
    {
        $this->campaign = $campaign;
    }

    public function apply($model, PrettusRepositoryInterface $repository)
    {
        return $model->where('campaign_id', '=', $this->campaign);
    }
}
