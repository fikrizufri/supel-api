<?php

namespace App\Containers\AppSection\Timses\UI\API\Controllers;


use App\Containers\AppSection\Timses\Actions\UpdateTimsesCardAction;
use App\Containers\AppSection\Timses\Actions\UploadTimsesLogoAction;
use App\Containers\AppSection\Timses\Actions\UploadTimsesPhotoAction;
use App\Containers\AppSection\Timses\UI\API\Requests\UpdateTimsesCardRequest;
use App\Containers\AppSection\Timses\UI\API\Requests\UploadTimsesPhotoRequest;
use App\Containers\AppSection\Timses\UI\API\Transformers\TimsesCardTransformer;
use App\Ship\Parents\Controllers\ApiController;

class UpdateTimsesCardController extends ApiController
{

    public function updateCard(UpdateTimsesCardRequest $request): array
    {
        $timses = app(UpdateTimsesCardAction::class)->run($request);

        return $this->transform($timses, TimsesCardTransformer::class);
    }

    public function uploadPhoto(UploadTimsesPhotoRequest $request): array
    {
        $timses = app(UploadTimsesPhotoAction::class)->run($request);

        return $this->transform($timses, TimsesCardTransformer::class);
    }

    public function uploadLogo(UploadTimsesPhotoRequest $request): array
    {
        $timses = app(UploadTimsesLogoAction::class)->run($request);

        return $this->transform($timses, TimsesCardTransformer::class);
    }

}
