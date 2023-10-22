<?php

/**
 * @apiGroup           Campaign
 * @apiName            GetAllCampaigns
 *
 * @api                {GET} /v1/campaigns Get All Campaigns
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

use App\Containers\AppSection\Campaign\UI\API\Controllers\FindSubGroupCampaignByIdController;
use Illuminate\Support\Facades\Route;

Route::get('subgroup/campaigns/{id}', [FindSubGroupCampaignByIdController::class, 'findById'])
    ->middleware(['auth:api']);

