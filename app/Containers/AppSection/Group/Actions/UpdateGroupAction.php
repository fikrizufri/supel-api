<?php

namespace App\Containers\AppSection\Group\Actions;


use App\Containers\AppSection\Group\Tasks\UpdateGroupTask;
use App\Containers\AppSection\Group\UI\API\Requests\UpdateGroupRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

class UpdateGroupAction extends ParentAction
{

    public function run(UpdateGroupRequest $request)
    {
        $data = $request->sanitizeInput([
            'group_name',
        ]);

        return app(UpdateGroupTask::class)->run($data, $request->id);
    }
}
