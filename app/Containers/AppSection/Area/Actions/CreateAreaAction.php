<?php

namespace App\Containers\AppSection\Area\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Area\Models\Area;
use App\Containers\AppSection\Area\Tasks\CreateAreaTask;
use App\Containers\AppSection\Area\UI\API\Requests\CreateAreaRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateAreaAction extends ParentAction
{
    /**
     * @param CreateAreaRequest $request
     * @return Area
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(CreateAreaRequest $request): Area
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return app(CreateAreaTask::class)->run($data);
    }
}
