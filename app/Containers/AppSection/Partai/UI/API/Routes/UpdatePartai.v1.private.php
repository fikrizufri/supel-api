<?php

/**
 * @apiGroup           Partai
 * @apiName            UpdatePartai
 *
 * @api                {PATCH} /v1/partai/:id Update Partai
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

use App\Containers\AppSection\Partai\UI\API\Controllers\UpdatePartaiController;
use Illuminate\Support\Facades\Route;

Route::post('partai/{id}', [UpdatePartaiController::class, 'updatePartai'])
    ->middleware(['auth:api']);

