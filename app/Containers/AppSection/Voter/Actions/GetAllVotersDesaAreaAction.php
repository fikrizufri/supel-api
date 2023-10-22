<?php

namespace App\Containers\AppSection\Voter\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Voter\Tasks\GetAllVotersDesaAreaTask;
use App\Containers\AppSection\Voter\UI\API\Requests\GetAllVotersRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllVotersDesaAreaAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllVotersRequest $request): mixed
    {
        return app(GetAllVotersDesaAreaTask::class)->run();
    }
}
