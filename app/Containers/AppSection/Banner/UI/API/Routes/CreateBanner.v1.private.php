<?php

/**
 * @apiGroup           Banner
 * @apiName            CreateBanner
 *
 * @api                {POST} /v1/banners Create Banner
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

use App\Containers\AppSection\Banner\UI\API\Controllers\CreateBannerController;
use Illuminate\Support\Facades\Route;

Route::post('banners', [CreateBannerController::class, 'createBanner'])
    ->middleware(['auth:api']);

