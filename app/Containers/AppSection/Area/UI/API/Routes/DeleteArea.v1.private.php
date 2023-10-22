<?php

/**
 * @apiGroup           Area
 * @apiName            DeleteArea
 *
 * @api                {DELETE} /v1/areas/:id Delete Area
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

use App\Containers\AppSection\Area\UI\API\Controllers\DeleteAreaController;
use Illuminate\Support\Facades\Route;

Route::delete('areas/{id}', [DeleteAreaController::class, 'deleteArea'])
    ->middleware(['auth:api']);

