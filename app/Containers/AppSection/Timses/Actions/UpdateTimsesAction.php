<?php

namespace App\Containers\AppSection\Timses\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Timses\Models\Timses;
use App\Containers\AppSection\Timses\Tasks\UpdateTimsesTask;
use App\Containers\AppSection\Timses\UI\API\Requests\UpdateTimsesRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateTimsesAction extends ParentAction
{
    /**
     * @param UpdateTimsesRequest $request
     * @return Timses
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(UpdateTimsesRequest $request): Timses
    {
        $data = $request->sanitizeInput([
            'name',
            'nick_name',
            'group_id',
        ]);

        return app(UpdateTimsesTask::class)->run($data, $request->id);
    }
}
