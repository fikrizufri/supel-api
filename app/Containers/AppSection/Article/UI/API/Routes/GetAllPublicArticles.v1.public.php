<?php

/**
 * @apiGroup           Article
 * @apiName            GetAllArticles
 *
 * @api                {GET} /v1/articles Get All Articles
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

use App\Containers\AppSection\Article\UI\API\Controllers\GetAllPublicArticlesController;
use Illuminate\Support\Facades\Route;

Route::get('public/articles', [GetAllPublicArticlesController::class, 'getAllArticles']);
