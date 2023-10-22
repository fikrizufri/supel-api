<?php

namespace App\Containers\AppSection\Area\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Area\Tasks\GetAllKecamatanAreasTask;
use App\Containers\AppSection\Area\UI\API\Requests\GetAllAreasRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllKecamatanAreasAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllAreasRequest $request): mixed
    {
        return app(GetAllKecamatanAreasTask::class)->run($request);
    }
}
