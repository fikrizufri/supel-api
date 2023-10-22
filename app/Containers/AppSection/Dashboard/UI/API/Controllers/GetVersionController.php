<?php

namespace App\Containers\AppSection\Dashboard\UI\API\Controllers;

use App\Containers\AppSection\Dashboard\Actions\GetVersionAction;
use App\Containers\AppSection\Dashboard\UI\API\Requests\GetVersionRequest;
use App\Containers\AppSection\Dashboard\UI\API\Transformers\AppversionTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetVersionController extends ApiController
{
    public function get(GetVersionRequest $request)
    {
        $version = app(GetVersionAction::class)->run($request);

        return $this->transform($version, AppversionTransformer::class);
    }
}
