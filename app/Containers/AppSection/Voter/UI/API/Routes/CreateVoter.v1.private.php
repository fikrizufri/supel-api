<?php

/**
 * @apiGroup           Voter
 * @apiName            CreateVoter
 *
 * @api                {POST} /v1/voters Create Voter
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

use App\Containers\AppSection\Voter\UI\API\Controllers\CreateVoterController;
use Illuminate\Support\Facades\Route;

Route::post('voters', [CreateVoterController::class, 'createVoter'])
    ->middleware(['auth:api']);

