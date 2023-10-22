<?php

/**
 * @apiGroup           Voter
 * @apiName            GetAllVoters
 *
 * @api                {GET} /v1/voters Get All Voters
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

use App\Containers\AppSection\Voter\UI\API\Controllers\GetAllSearchVotersController;
use Illuminate\Support\Facades\Route;

Route::post('search/voters', [GetAllSearchVotersController::class, 'getAllVoters'])
    ->middleware(['auth:api']);

