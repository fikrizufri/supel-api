<?php

/**
 * @apiGroup           Timses
 * @apiName            CreateTimses
 *
 * @api                {POST} /v1/timses Create Timses
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

use App\Containers\AppSection\Timses\UI\API\Controllers\CreateTimsesController;
use Illuminate\Support\Facades\Route;

Route::post('timses', [CreateTimsesController::class, 'createTimses'])
    ->middleware(['auth:api']);

