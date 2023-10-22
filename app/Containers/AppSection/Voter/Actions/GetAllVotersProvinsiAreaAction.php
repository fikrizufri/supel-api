<?php

namespace App\Containers\AppSection\Voter\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Voter\Tasks\GetAllVotersProvinsiAreaTask;
use App\Containers\AppSection\Voter\UI\API\Requests\GetAllVotersRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllVotersProvinsiAreaAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllVotersRequest $request): mixed
    {
        return app(GetAllVotersProvinsiAreaTask::class)->run();
    }
}
