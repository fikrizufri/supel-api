<?php

/**
 * @apiGroup           Simpatisan
 * @apiName            FindSimpatisanById
 *
 * @api                {GET} /v1/simpatisans/:id Find Simpatisan By Id
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

use App\Containers\AppSection\Simpatisan\UI\API\Controllers\FindSimpatisanByIdController;
use Illuminate\Support\Facades\Route;

Route::get('simpatisan/{id}', [FindSimpatisanByIdController::class, 'findSimpatisanById'])
    ->middleware(['auth:api']);

