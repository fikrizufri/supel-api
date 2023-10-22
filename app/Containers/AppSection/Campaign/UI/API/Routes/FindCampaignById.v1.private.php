<?php

/**
 * @apiGroup           Campaign
 * @apiName            FindCampaignById
 *
 * @api                {GET} /v1/campaigns/:id Find Campaign By Id
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

use App\Containers\AppSection\Campaign\UI\API\Controllers\FindCampaignByIdController;
use Illuminate\Support\Facades\Route;

Route::get('campaigns/{id}', [FindCampaignByIdController::class, 'findCampaignById'])
    ->middleware(['auth:api']);

