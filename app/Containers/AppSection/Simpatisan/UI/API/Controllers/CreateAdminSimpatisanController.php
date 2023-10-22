<?php

namespace App\Containers\AppSection\Simpatisan\UI\API\Controllers;

use App\Containers\AppSection\Simpatisan\Actions\CreateAdminSimpatisanAction;
use App\Containers\AppSection\Simpatisan\UI\API\Requests\CreateAdminSimpatisanRequest;
use App\Containers\AppSection\Simpatisan\UI\API\Transformers\SimpatisanTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\JsonResponse;

class CreateAdminSimpatisanController extends ApiController
{

    public function createSimpatisan(CreateAdminSimpatisanRequest $request): JsonResponse
    {
        $simpatisan = app(CreateAdminSimpatisanAction::class)->run($request);

        return $this->created($this->transform($simpatisan, SimpatisanTransformer::class));
    }
}
