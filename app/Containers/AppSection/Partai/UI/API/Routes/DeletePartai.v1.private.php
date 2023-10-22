<?php

/**
 * @apiGroup           Partai
 * @apiName            DeletePartai
 *
 * @api                {DELETE} /v1/partai/:id Delete Partai
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

use App\Containers\AppSection\Partai\UI\API\Controllers\DeletePartaiController;
use Illuminate\Support\Facades\Route;

Route::delete('partai/{id}', [DeletePartaiController::class, 'deletePartai'])
    ->middleware(['auth:api']);

