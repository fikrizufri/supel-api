<?php

/**
 * @apiGroup           Voter
 * @apiName            UpdateVoter
 *
 * @api                {PATCH} /v1/voters/:id Update Voter
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

use App\Containers\AppSection\Voter\UI\API\Controllers\UpdateVoterController;
use Illuminate\Support\Facades\Route;

Route::patch('voters/{id}', [UpdateVoterController::class, 'updateVoter'])
    ->middleware(['auth:api']);

