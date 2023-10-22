<?php

/**
 * @apiGroup           Voter
 * @apiName            DeleteVoter
 *
 * @api                {DELETE} /v1/voters/:id Delete Voter
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

use App\Containers\AppSection\Voter\UI\API\Controllers\DeleteVoterController;
use Illuminate\Support\Facades\Route;

Route::delete('voters/{id}', [DeleteVoterController::class, 'deleteVoter'])
    ->middleware(['auth:api']);

