<?php

/**
 * @apiGroup           Simpatisan
 * @apiName            CreateSimpatisan
 *
 * @api                {POST} /v1/simpatisans Create Simpatisan
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

use App\Containers\AppSection\Simpatisan\UI\API\Controllers\CreateAdminSimpatisanController;
use Illuminate\Support\Facades\Route;

Route::post('admin/simpatisan', [CreateAdminSimpatisanController::class, 'createSimpatisan'])
    ->middleware(['auth:api']);

