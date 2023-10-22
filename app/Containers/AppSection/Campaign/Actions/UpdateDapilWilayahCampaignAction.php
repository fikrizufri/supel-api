<?php

namespace App\Containers\AppSection\Campaign\Actions;


use App\Containers\AppSection\Campaign\Models\DapilWilayahCampaign;
use App\Containers\AppSection\Campaign\Tasks\CreateDapilWilayahCampaignTask;
use App\Containers\AppSection\Campaign\Tasks\FindDapilCampaignByIdTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\UpdateDapilWilayahCampaignRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateDapilWilayahCampaignAction extends ParentAction
{

    public function run(UpdateDapilWilayahCampaignRequest $request)
    {
        $wilayah = $request->wilayah;
        $dapil = app(FindDapilCampaignByIdTask::class)->run($request->id);

        DapilWilayahCampaign::where('dapil_id', $request->id)->delete();

        if (!empty($wilayah) && is_array($wilayah)) {
            foreach ($wilayah as $kode) {
                if ($dapil->subgroup === 'DPRK') {
                    if (is_array($kode)) {
                        $arrayData = array(
                            'dapil_id' => $request->id,
                            'kode_kabupaten' => $kode['kode_kabupaten'],
                            'kode_kecamatan' => $kode['kode_kecamatan'],
                        );
                    }
                } else {
                    if (is_array($kode)) {
                        $arrayData = array(
                            'dapil_id' => $request->id,
                            'kode_kabupaten' => $kode['kode_kabupaten'],
                        );
                    }
                }

                app(CreateDapilWilayahCampaignTask::class)->run($arrayData);
            }
        }

        return true;

    }
}
