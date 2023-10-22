<?php

/**
 * @apiGroup           Note
 * @apiName            UpdateNote
 *
 * @api                {PATCH} /v1/notes/:id Update Note
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

use App\Containers\AppSection\Note\UI\API\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::patch('notes/{id}', [Controller::class, 'updateNote'])
    ->middleware(['auth:api']);

