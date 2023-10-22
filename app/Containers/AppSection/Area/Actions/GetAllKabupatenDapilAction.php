<?php

namespace App\Containers\AppSection\Area\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Area\Tasks\GetAllKabupatenAreasTask;
use App\Containers\AppSection\Area\Tasks\GetAllKabupatenDapilTask;
use App\Containers\AppSection\Area\UI\API\Requests\GetAllAreasRequest;
use App\Containers\AppSection\Campaign\Models\Campaign;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllKabupatenDapilAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllAreasRequest $request): mixed
    {
        $user = $request->user();

        if($user->hasRole('superadmin') || $user->hasRole('adminpartai')) {
            return app(GetAllKabupatenAreasTask::class)->run($request);
        }

        if (!$user) {
            throw new NotFoundException('Data user tidak diketemukan.');
        }

        if($user->hasRole('adminkandidat')) {
            $campaign = Campaign::where('id', $user->campaign_id)->select('subgroup_campaign_id', 'kode_provinsi', 'kode_kabupaten', 'kode_dapil')->first();
        } else {
            $timses = Timses::whereUserId($user->id)->first();

            if (!$timses) {
                throw new NotFoundException('Data timses tidak diketemukan.');
            }

            $campaign = Campaign::where('id_akun', $timses->default_campaign_id)->select('subgroup_campaign_id', 'kode_provinsi', 'kode_kabupaten', 'kode_dapil')->first();
        }

        if (!$campaign) {
            throw new NotFoundException('Data campaign tidak diketemukan.');
        }

        return app(GetAllKabupatenDapilTask::class)->run($campaign);
    }
}
