<?php

namespace App\Containers\AppSection\Authentication\UI\API\Controllers;

use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Authentication\Actions\AddTimsesCampaignAction;
use App\Containers\AppSection\Authentication\Actions\RegisterCampaignAction;
use App\Containers\AppSection\Authentication\Actions\RegisterUserAction;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterCampaignRequest;
use App\Containers\AppSection\Authentication\UI\API\Requests\RegisterUserRequest;
use App\Containers\AppSection\Timses\UI\API\Transformers\TimsesTransformer;
use App\Containers\AppSection\User\UI\API\Transformers\UserTransformer;
use App\Ship\Parents\Controllers\ApiController;

class RegisterUserController extends ApiController
{

    public function registerUser(RegisterUserRequest $request)
    {
        $timses = app(RegisterUserAction::class)->run($request);

        return $this->json($timses);
    }

    public function registerCampaign(RegisterCampaignRequest $request)
    {
        $timses = app(RegisterCampaignAction::class)->transactionalRun($request);

        return $this->json($timses);
    }

    public function addCampaign(RegisterCampaignRequest $request)
    {
        $timses = app(AddTimsesCampaignAction::class)->transactionalRun($request);

        return $this->json($timses);
    }
}
