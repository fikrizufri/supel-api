<?php

namespace App\Containers\AppSection\Partai\Actions;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use App\Containers\AppSection\Partai\Tasks\GetAllPublicPartaisTask;
use App\Containers\AppSection\Partai\UI\API\Requests\GetAllPartaisRequest;
use App\Ship\Parents\Actions\Action as ParentAction;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllPublicPartaisAction extends ParentAction
{
    /**
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function run(GetAllPartaisRequest $request): mixed
    {
        return app(GetAllPublicPartaisTask::class)->run();
    }
}
