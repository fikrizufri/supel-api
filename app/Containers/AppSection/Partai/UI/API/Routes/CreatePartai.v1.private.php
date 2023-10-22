<?php

/**
 * @apiGroup           Partai
 * @apiName            CreatePartai
 *
 * @api                {POST} /v1/partai Create Partai
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

use App\Containers\AppSection\Partai\UI\API\Controllers\CreatePartaiController;
use Illuminate\Support\Facades\Route;

Route::post('partai', [CreatePartaiController::class, 'createPartai'])
    ->middleware(['auth:api']);

