<?php

namespace App\Containers\AppSection\Timses\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Tasks\GetAllCampaignTimsesTask;
use App\Containers\AppSection\Timses\UI\API\Requests\GetAllTimsesRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllCampaignTimsesAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllTimsesRequest $request): mixed
    {
        $user = $request->user();

        if (!$user) {
            throw new NotFoundException('Data user tidak ditemukan.');
        }

        $timses = Timses::whereUserId($user->id)->first();

        if (!$timses) {
            throw new NotFoundException('Data timses tidak ditemukan.');
        }

        return app(GetAllCampaignTimsesTask::class)->run($timses->id);
    }
}
