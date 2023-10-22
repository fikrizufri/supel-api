<?php

namespace App\Containers\AppSection\Campaign\Actions;


use App\Containers\AppSection\Campaign\Models\DapilCampaign;
use App\Containers\AppSection\Campaign\Tasks\CreateDapilCampaignTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\CreateDapilCampaignRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateDapilCampaignAction extends ParentAction
{

    public function run(CreateDapilCampaignRequest $request): DapilCampaign
    {

        $data = $request->sanitizeInput([
            'subgroup',
            'name',
            'kode_provinsi',
            'nama_provinsi',
        ]);

        return app(CreateDapilCampaignTask::class)->run($data);
    }
}
