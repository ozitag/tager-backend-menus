<?php

use Illuminate\Support\Facades\Route;
use OZiTAG\Tager\Backend\Menus\Controllers\PublicController;
use OZiTAG\Tager\Backend\Menus\Controllers\AdminController;
use OZiTAG\Tager\Backend\Rbac\Facades\AccessControlMiddleware;
use OZiTAG\Tager\Backend\Menus\Enums\MenusScope;

Route::group(['prefix' => 'tager/menus', 'middleware' => 'api.cache'], function () {
    Route::get('/{alias}', [PublicController::class, 'menu']);
});

Route::group(['prefix' => 'admin', 'middleware' => ['passport:administrators', 'auth:api', AccessControlMiddleware::scopes(MenusScope::Edit)]], function () {
    Route::get('/menus', [AdminController::class, 'index']);
    Route::post('/menus', [AdminController::class, 'create']);
    Route::get('/menus/{id}', [AdminController::class, 'view']);
    Route::get('/menus/{alias}', [AdminController::class, 'viewByAlias']);
    Route::put('/menus/{id}', [AdminController::class, 'update']);
    Route::delete('/menus/{id}', [AdminController::class, 'delete']);

    Route::get('/menus/{alias}/items', [AdminController::class, 'viewItems']);
    Route::put('/menus/{alias}/items', [AdminController::class, 'updateItems']);
});
