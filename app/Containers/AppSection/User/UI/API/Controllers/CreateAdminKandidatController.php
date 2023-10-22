<?php

namespace App\Containers\AppSection\User\UI\API\Controllers;


use App\Containers\AppSection\User\Actions\CreateAdminGroupAction;
use App\Containers\AppSection\User\UI\API\Requests\CreateAdminKandidatRequest;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class CreateAdminKandidatController extends ApiController
{
    public function createAdminKandidat(CreateAdminKandidatRequest $request): array
    {
        $user = app(CreateAdminGroupAction::class)->run($request);

        return $this->transform($user, UserTransformer::class);
    }
}
