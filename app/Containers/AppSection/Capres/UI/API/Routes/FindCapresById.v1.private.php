<?php

/**
 * @apiGroup           Capres
 * @apiName            FindCapresById
 *
 * @api                {GET} /v1/capres/:id Find Capres By Id
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

use App\Containers\AppSection\Capres\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('capres/{id}', [Controller::class, 'findCapresById'])
    ->middleware(['auth:api']);

