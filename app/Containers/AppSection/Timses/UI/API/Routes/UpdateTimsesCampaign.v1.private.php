<?php

/**
 * @apiGroup           Timses
 * @apiName            UpdateTimses
 *
 * @api                {PATCH} /v1/timses/:id Update Timses
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

use App\Containers\AppSection\Timses\UI\API\Controllers\UpdateTimsesCampaignController;
use Illuminate\Support\Facades\Route;

Route::post('timses/campaign/{id}', [UpdateTimsesCampaignController::class, 'updateTimses'])
    ->middleware(['auth:api']);

