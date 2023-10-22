<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;


use App\Containers\AppSection\Authentication\Actions\RegisterNewUserAction;
use App\Containers\AppSection\Authentication\Actions\RegisterTestUserAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterNewUserRequest;
use App\Ship\Parents\Controllers\ApiController;

class RegisterNewUserController extends ApiController
{

    public function regis(RegisterNewUserRequest $request)
    {
        $response = app(RegisterNewUserAction::class)->run($request);

        return $this->json($response);
    }

    public function testRegis(RegisterNewUserRequest $request)
    {
        $response = app(RegisterTestUserAction::class)->run($request);

        return $this->json($response);
    }

}
