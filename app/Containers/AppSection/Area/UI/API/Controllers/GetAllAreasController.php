<?php

namespace App\Containers\AppSection\Area\UI\API\Controllers;

use Apiato\Core\Exceptions\CoreInternalErrorException;
use Apiato\Core\Exceptions\InvalidTransformerException;
use App\Containers\AppSection\Area\Actions\GetAllAreasAction;
use App\Containers\AppSection\Area\Actions\GetAllKabupatenAreasAction;
use App\Containers\AppSection\Area\Actions\GetAllKabupatenDapilAction;
use App\Containers\AppSection\Area\Actions\GetAllKecamatanAreasAction;
use App\Containers\AppSection\Area\Actions\GetAllKecamatanDapilAction;
use App\Containers\AppSection\Area\Actions\GetAllKelurahanAreasAction;
use App\Containers\AppSection\Area\Actions\GetAllKelurahanDapilAction;
use App\Containers\AppSection\Area\Actions\GetAllProvinceAreasAction;
use App\Containers\AppSection\Area\Actions\GetAllProvinceDapilAction;
use App\Containers\AppSection\Area\UI\API\Requests\GetAllAreasRequest;
use App\Ship\Parents\Controllers\ApiController;
use Prettus\Repository\Exceptions\RepositoryException;

class GetAllAreasController extends ApiController
{
    /**
     * @throws InvalidTransformerException
     * @throws CoreInternalErrorException
     * @throws RepositoryException
     */
    public function getAllAreas(GetAllAreasRequest $request)
    {
        $areas = app(GetAllAreasAction::class)->run($request);

        return $this->json($areas);
    }

    public function getAllProvinceAreas(GetAllAreasRequest $request)
    {
        $areas = app(GetAllProvinceAreasAction::class)->run($request);

        return $this->json($areas);
    }

    public function getAllKabupatenAreas(GetAllAreasRequest $request)
    {
        $areas = app(GetAllKabupatenAreasAction::class)->run($request);

        return $this->json($areas);
    }

    public function getAllKecamatanAreas(GetAllAreasRequest $request)
    {
        $areas = app(GetAllKecamatanAreasAction::class)->run($request);

        return $this->json($areas);
    }

    public function getAllKelurahanAreas(GetAllAreasRequest $request)
    {
        $areas = app(GetAllKelurahanAreasAction::class)->run($request);

        return $this->json($areas);
    }

    public function getAllProvinceDapil(GetAllAreasRequest $request)
    {
        $areas = app(GetAllProvinceDapilAction::class)->run($request);
        $data = array('data' => $areas);
        return $this->json($data);
    }

    public function getAllKabupatenDapil(GetAllAreasRequest $request)
    {
        $areas = app(GetAllKabupatenDapilAction::class)->run($request);
        $data = array('data' => $areas);
        return $this->json($data);
    }

    public function getAllKecamatanDapil(GetAllAreasRequest $request)
    {
        $areas = app(GetAllKecamatanDapilAction::class)->run($request);
        $data = array('data' => $areas);
        return $this->json($data);
    }

    public function getAllKelurahanDapil(GetAllAreasRequest $request)
    {
        $areas = app(GetAllKelurahanDapilAction::class)->run($request);
        $data = array('data' => $areas);
        return $this->json($data);
    }
}
