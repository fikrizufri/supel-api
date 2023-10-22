<?php

/**
 * @apiGroup           Area
 * @apiName            FindAreaById
 *
 * @api                {GET} /v1/areas/:id Find Area By Id
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

use App\Containers\AppSection\Area\UI\API\Controllers\FindAreaByIdController;
use Illuminate\Support\Facades\Route;

Route::get('areas/{id}', [FindAreaByIdController::class, 'findAreaById'])
    ->middleware(['auth:api']);

