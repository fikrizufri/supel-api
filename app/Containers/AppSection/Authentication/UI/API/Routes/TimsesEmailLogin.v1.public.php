<?php

/**
 * @apiGroup           Authentication
 * @apiName            LoginTimses
 *
 * @api                {POST} /v1/timses/login Login Timses
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

use App\Containers\AppSection\Authentication\UI\API\Controllers\LoginTimsesController;
use Illuminate\Support\Facades\Route;

Route::post('timses/login-email', [LoginTimsesController::class, 'LoginWithEmail']);

