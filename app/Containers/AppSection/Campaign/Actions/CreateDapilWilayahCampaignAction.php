<?php

namespace App\Containers\AppSection\Campaign\Actions;


use App\Containers\AppSection\Campaign\Tasks\CreateDapilWilayahCampaignTask;
use App\Containers\AppSection\Campaign\UI\API\Requests\CreateDapilWilayahCampaignRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateDapilWilayahCampaignAction extends ParentAction
{

    public function run(CreateDapilWilayahCampaignRequest $request)
    {
        $wilayah = $request->wilayah;
        $id = $request->id;

        if (!empty($wilayah) && is_array($wilayah)) {
            foreach ($wilayah as $kode) {
                if ($request->subgroup === 'DPRK') {
                    if (is_array($kode)) {
                        $arrayData = array(
                            'dapil_id' => $id,
                            'kode_kabupaten' => $kode['kode_kabupaten'],
                            'kode_kecamatan' => $kode['kode_kecamatan'],
                        );
                    }
                } else {
                    $arrayData = array(
                        'dapil_id' => $id,
                        'kode_kabupaten' => $kode,
                    );
                }

                app(CreateDapilWilayahCampaignTask::class)->run($arrayData);
            }
        }

        return true;

    }
}
