<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use App\Containers\AppSection\Authentication\Actions\ApiLoginEmailTimsesAction;
use App\Containers\AppSection\Authentication\Actions\ApiLoginTimsesAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\LoginTimsesRequest;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class LoginTimsesController extends ApiController
{

    public function LoginTimses(LoginTimsesRequest $request): JsonResponse
    {

        $auth = app(ApiLoginTimsesAction::class)->run($request);

        return $this->json($auth);
    }

    public function LoginWithEmail(LoginTimsesRequest $request): JsonResponse
    {

        $auth = app(ApiLoginEmailTimsesAction::class)->run($request);

        return $this->json($auth);
    }
}
