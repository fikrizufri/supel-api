<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;


use App\Containers\AppSection\Authentication\Actions\RegisterPhoneUserAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterPhoneUserRequest;
use App\Ship\Parents\Controllers\ApiController;

class RegisterPhoneUserController extends ApiController
{

    public function regisPhone(RegisterPhoneUserRequest $request)
    {
        $response = app(RegisterPhoneUserAction::class)->run($request);

        return $this->json($response);
    }

}
