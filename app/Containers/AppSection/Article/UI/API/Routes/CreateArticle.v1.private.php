<?php

/**
 * @apiGroup           Article
 * @apiName            CreateArticle
 *
 * @api                {POST} /v1/articles Create Article
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

use App\Containers\AppSection\Article\UI\API\Controllers\CreateArticleController;
use Illuminate\Support\Facades\Route;

Route::post('articles', [CreateArticleController::class, 'createArticle'])
    ->middleware(['auth:api']);

