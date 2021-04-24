<?php

use Illuminate\Support\Facades\Route;
use OZiTAG\Tager\Backend\Menus\Controllers\PublicController;
use OZiTAG\Tager\Backend\Menus\Controllers\AdminController;
use OZiTAG\Tager\Backend\Rbac\Facades\AccessControlMiddleware;
use OZiTAG\Tager\Backend\Menus\Enums\MenusScope;

Route::group(['prefix' => 'tager/menus', 'middleware' => 'api.cache'], function () {
    Route::get('/{alias}', [PublicController::class, 'viewMenu']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['passport:administrators', 'auth:api']], function () {
    Route::group(['middleware' => [AccessControlMiddleware::scopes(MenusScope::Edit)]], function () {
        Route::get('/menus/{alias}', [AdminController::class, 'view']);
        Route::put('/menus/{alias}', [AdminController::class, 'update']);
    });
});
