<?php

/**
 * @apiGroup           Area
 * @apiName            UpdateArea
 *
 * @api                {PATCH} /v1/areas/:id Update Area
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

use App\Containers\AppSection\Area\UI\API\Controllers\UpdateAreaController;
use Illuminate\Support\Facades\Route;

Route::patch('areas/{id}', [UpdateAreaController::class, 'updateArea'])
    ->middleware(['auth:api']);

