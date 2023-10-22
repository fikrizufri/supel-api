<?php

namespace App\Containers\AppSection\Area\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Area\Models\Area;
use App\Containers\AppSection\Area\Tasks\UpdateAreaTask;
use App\Containers\AppSection\Area\UI\API\Requests\UpdateAreaRequest;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateAreaAction extends ParentAction
{
    /**
     * @param UpdateAreaRequest $request
     * @return Area
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function run(UpdateAreaRequest $request): Area
    {
        $data = $request->sanitizeInput([
            // add your request data here
        ]);

        return app(UpdateAreaTask::class)->run($data, $request->id);
    }
}
