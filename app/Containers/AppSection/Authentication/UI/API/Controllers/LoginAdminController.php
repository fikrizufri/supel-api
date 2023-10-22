<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\ApiCustomLoginAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class LoginAdminController extends ApiController
{

    public function Login(LoginRequest $request): JsonResponse
    {

        $auth = app(ApiCustomLoginAction::class)->run($request);

        return $this->json($auth);
    }
}
