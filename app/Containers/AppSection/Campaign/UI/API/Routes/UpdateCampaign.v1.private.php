<?php

/**
 * @apiGroup           Campaign
 * @apiName            UpdateCampaign
 *
 * @api                {PATCH} /v1/campaigns/:id Update Campaign
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

use App\Containers\AppSection\Campaign\UI\API\Controllers\UpdateCampaignController;
use Illuminate\Support\Facades\Route;

Route::post('campaigns/{id}', [UpdateCampaignController::class, 'updateCampaign'])
    ->middleware(['auth:api']);

