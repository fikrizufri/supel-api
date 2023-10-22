<?php

namespace App\Containers\AppSection\Timses\UI\API\Controllers;

use Apiato\Core\Exceptions\IncorrectIdException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Timses\Actions\UpdateTimsesAction;
use App\Containers\AppSection\Timses\Models\TimsesCampaign;
use App\Containers\AppSection\Timses\Tasks\FindTimsesCampaignByIdTask;
use App\Containers\AppSection\Timses\UI\API\Requests\AproveTimsesCampaignRequest;
use App\Containers\AppSection\Timses\UI\API\Requests\UpdateTimsesRequest;
use App\Containers\AppSection\Timses\UI\API\Transformers\TimsesCampaignTransformer;
use App\Containers\AppSection\Timses\UI\API\Transformers\TimsesTransformer;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Controllers\ApiController;

class UpdateTimsesController extends ApiController
{
    /**
     * @param UpdateTimsesRequest $request
     * @return array
     * @throws InvalidTransformerException
     * @throws UpdateResourceFailedException
     * @throws IncorrectIdException
     * @throws NotFoundException
     */
    public function updateTimses(UpdateTimsesRequest $request): array
    {
        $timses = app(UpdateTimsesAction::class)->run($request);

        return $this->transform($timses, TimsesTransformer::class);
    }

    public function approveTimsesCampaign(AproveTimsesCampaignRequest $request)
    {

        $status = $request->status;

        TimsesCampaign::whereId($request->id)->update(['status' => $status]);

        return $this->noContent();
    }
}
