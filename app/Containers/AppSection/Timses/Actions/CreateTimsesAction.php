<?php

namespace App\Containers\AppSection\Timses\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Tasks\CreateTimsesTask;
use App\Containers\AppSection\Timses\UI\API\Requests\CreateTimsesRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateTimsesAction extends ParentAction
{
    /**
     * @param CreateTimsesRequest $request
     * @return Timses
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(CreateTimsesRequest $request): Timses
    {
        $data = $request->sanitizeInput([
            'user_id',
            'name',
            'nick_name',
            'phone',
            'nik',
        ]);

        return app(CreateTimsesTask::class)->run($data);
    }
}
