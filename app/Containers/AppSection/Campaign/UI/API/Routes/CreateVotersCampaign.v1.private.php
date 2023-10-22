<?php

/**
 * @apiGroup           Campaign
 * @apiName            CreateCampaign
 *
 * @api                {POST} /v1/campaigns Create Campaign
 * @apiDescription     Endpoint description here...
 *
 * @apiVersion         1.0.0
 * @apiPermission      Authenticated ['permissions' => '', 'roles' => '']
 *
 * @apiHeader          {String} accept=application/json
 * @apiHeader          {String} authorization=Bearer
 *
 * @apiParam           {String} parameters here...
 *
 * @apiSuccessExample  {json} Success-Response:
 * HTTP/1.1 200 OK
 * {
 *     // Insert the response of the request here...
 * }
 */

use App\Containers\AppSection\Campaign\UI\API\Controllers\CreateVotersCampaignController;
use Illuminate\Support\Facades\Route;

Route::post('campaign-voters/add', [CreateVotersCampaignController::class, 'CreateVoters'])
    ->middleware(['auth:api']);

