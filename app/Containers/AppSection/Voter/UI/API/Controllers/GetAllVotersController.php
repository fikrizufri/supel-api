<?php

namespace App\Containers\AppSection\Voter\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Voter\Actions\GetAllVotersAction;
use App\Containers\AppSection\Voter\Actions\GetVotersAreaAction;
use App\Containers\AppSection\Voter\Actions\GetAllVotersAreaAction;
use App\Containers\AppSection\Voter\Actions\GetAllVotersDesaAreaAction;
use App\Containers\AppSection\Voter\Actions\GetAllVotersKabupatenAreaAction;
use App\Containers\AppSection\Voter\Actions\GetAllVotersKecamatanAreaAction;
use App\Containers\AppSection\Voter\Actions\GetAllVotersProvinsiAreaAction;
use App\Containers\AppSection\Voter\Tasks\GetAllVotersDesaAreaTask;
use App\Containers\AppSection\Voter\Tasks\GetAllVotersKabupatenAreaTask;
use App\Containers\AppSection\Voter\Tasks\GetAllVotersKecamatanAreaTask;
use App\Containers\AppSection\Voter\UI\API\Requests\GetAllVotersRequest;
use App\Containers\AppSection\Voter\UI\API\Transformers\VoterTransformer;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllVotersController extends ApiController
{
    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAllVoters(GetAllVotersRequest $request): array
    {
        $voters = app(GetAllVotersAction::class)->run($request);

        $agregateKabupaten = app(GetAllVotersKabupatenAreaTask::class)->run();
        $agregateKecamatan = app(GetAllVotersKecamatanAreaTask::class)->run();
        $agregateDesa = app(GetAllVotersDesaAreaTask::class)->run();
        $aggregate = array(
            "aggregate" => [
                "kabupaten" => $agregateKabupaten,
                "kecamatan" => $agregateKecamatan,
                "desa" => $agregateDesa,
            ]
        );

        return $this->transform($voters, VoterTransformer::class, [], $aggregate);
    }

    public function getAllVotersArea(GetAllVotersRequest $request): array
    {
        $voters = app(GetAllVotersAreaAction::class)->run($request);

        return $this->transform($voters, VoterTransformer::class);
    }

    public function getAllVotersProvinsi(GetAllVotersRequest $request): array
    {
        $voters = app(GetAllVotersProvinsiAreaAction::class)->run($request);

        return $this->transform($voters, VoterTransformer::class);
    }

    public function getAllVotersKabupaten(GetAllVotersRequest $request): array
    {
        $voters = app(GetAllVotersKabupatenAreaAction::class)->run($request);

        return $this->transform($voters, VoterTransformer::class);
    }

    public function getAllVotersKecamatan(GetAllVotersRequest $request): array
    {
        $voters = app(GetAllVotersKecamatanAreaAction::class)->run($request);

        return $this->transform($voters, VoterTransformer::class);
    }

    public function getAllVotersDesa(GetAllVotersRequest $request): array
    {
        $voters = app(GetAllVotersDesaAreaAction::class)->run($request);

        return $this->transform($voters, VoterTransformer::class);
    }

}