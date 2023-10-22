<?php

namespace App\Containers\AppSection\Campaign\UI\API\Controllers;


use App\Containers\AppSection\Campaign\Actions\GetAllTimsesVotersCampaignNameAction;
use App\Containers\AppSection\Campaign\Actions\GetAllTimsesVotersCampaignsAction;
use App\Containers\AppSection\Campaign\Actions\GetAllTimsesVotersKabupatenAction;
use App\Containers\AppSection\Campaign\Actions\GetAllTimsesVotersKecamatanAction;
use App\Containers\AppSection\Campaign\Actions\GetAllTimsesVotersKelurahanAction;
use App\Containers\AppSection\Campaign\Actions\GetAllTimsesVotersTpsAction;
use App\Containers\AppSection\Campaign\UI\API\Requests\GetAllVotersCampaignsRequest;
use App\Containers\AppSection\Campaign\UI\API\Transformers\AllVotersCampaignTransformer;
use App\Ship\Parents\Controllers\ApiController;

class GetAllTimsesVotersCampaignsController extends ApiController
{
    public function get(GetAllVotersCampaignsRequest $request): array
    {
        $campaigns = app(GetAllTimsesVotersCampaignsAction::class)->run($request);

        return $this->transform($campaigns, AllVotersCampaignTransformer::class);
    }

    public function kabupaten(GetAllVotersCampaignsRequest $request)
    {
        $area = app(GetAllTimsesVotersKabupatenAction::class)->run($request);
        $data = array('data' => $area);
        return $this->json($data);
    }

    public function kecamatan(GetAllVotersCampaignsRequest $request)
    {
        $area = app(GetAllTimsesVotersKecamatanAction::class)->run($request);
        $data = array('data' => $area);
        return $this->json($data);
    }

    public function kelurahan(GetAllVotersCampaignsRequest $request)
    {
        $area = app(GetAllTimsesVotersKelurahanAction::class)->run($request);
        $data = array('data' => $area);
        return $this->json($data);
    }

    public function getCampaignName(GetAllVotersCampaignsRequest $request)
    {
        $area = app(GetAllTimsesVotersCampaignNameAction::class)->run($request);
        $data = array('data' => $area);
        return $this->json($data);
    }

    public function getTps(GetAllVotersCampaignsRequest $request)
    {
        $area = app(GetAllTimsesVotersTpsAction::class)->run($request);
        $data = array('data' => $area);
        return $this->json($data);
    }
}
