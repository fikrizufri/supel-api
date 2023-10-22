<?php

/**
 * @apiGroup           Article
 * @apiName            FindArticleById
 *
 * @api                {GET} /v1/articles/:id Find Article By Id
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

use App\Containers\AppSection\Article\UI\API\Controllers\FindArticleByIdController;
use Illuminate\Support\Facades\Route;

Route::get('articles/{id}', [FindArticleByIdController::class, 'findArticleById'])
    ->middleware(['auth:api']);

