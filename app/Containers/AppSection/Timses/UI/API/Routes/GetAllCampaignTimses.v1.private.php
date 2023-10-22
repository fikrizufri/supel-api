<?php

/**
 * @apiGroup           Timses
 * @apiName            GetAllTimses
 *
 * @api                {GET} /v1/timses Get All Timses
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

use App\Containers\AppSection\Timses\UI\API\Controllers\GetAllCampaignTimsesController;
use Illuminate\Support\Facades\Route;

Route::get('timses/campaign/all', [GetAllCampaignTimsesController::class, 'getAll'])
    ->middleware(['auth:api']);

