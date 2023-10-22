<?php

namespace App\Containers\AppSection\Group\Actions;

use Apiato\Core\Exceptions\IncorrectIdException;
use App\Containers\AppSection\Group\Models\Group;
use App\Containers\AppSection\Group\Tasks\CreateGroupTask;
use App\Containers\AppSection\Group\UI\API\Requests\CreateGroupRequest;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Actions\Action as ParentAction;

class CreateGroupAction extends ParentAction
{
    /**
     * @param CreateGroupRequest $request
     * @return Group
     * @throws CreateResourceFailedException
     * @throws IncorrectIdException
     */
    public function run(CreateGroupRequest $request): Group
    {
        $user = $request->user();

        $data = $request->sanitizeInput([
            'group_name',
        ]);

        $data['campaign_id'] = $user->campaign_id;

        return app(CreateGroupTask::class)->run($data);
    }
}
