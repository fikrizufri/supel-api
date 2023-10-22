<?php

namespace App\Containers\AppSection\Partai\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Partai\Tasks\GetSelectPartaisTask;
use App\Containers\AppSection\Partai\UI\API\Requests\GetAllPartaisRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetSelectPartaisAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllPartaisRequest $request): mixed
    {
        return app(GetSelectPartaisTask::class)->run();
    }
}
