<?php

/**
 * @apiGroup           Article
 * @apiName            UpdateArticle
 *
 * @api                {PATCH} /v1/articles/:id Update Article
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

use App\Containers\AppSection\Article\UI\API\Controllers\UpdateArticleController;
use Illuminate\Support\Facades\Route;

Route::post('articles/{id}', [UpdateArticleController::class, 'updateArticle'])
    ->middleware(['auth:api']);

