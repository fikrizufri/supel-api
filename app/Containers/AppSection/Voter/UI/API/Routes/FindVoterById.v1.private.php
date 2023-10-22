<?php

/**
 * @apiGroup           Voter
 * @apiName            FindVoterById
 *
 * @api                {GET} /v1/voters/:id Find Voter By Id
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

use App\Containers\AppSection\Voter\UI\API\Controllers\FindVoterByIdController;
use Illuminate\Support\Facades\Route;

Route::get('voters/{id}', [FindVoterByIdController::class, 'findVoterById']);

