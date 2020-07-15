<?php

use Illuminate\Support\Facades\Route;

Route::get('/tager/menu/{alias}', \OZiTAG\Tager\Backend\Menus\Controllers\PublicController::class . '@menu');

Route::group(['prefix' => 'admin', 'middleware' => ['passport:administrators', 'auth:api']], function () {
    Route::get('/menus', \OZiTAG\Tager\Backend\Menus\Controllers\AdminController::class . '@index');
    Route::put('/menus', \OZiTAG\Tager\Backend\Menus\Controllers\AdminController::class . '@create');
    Route::get('/menus/{id}', \OZiTAG\Tager\Backend\Menus\Controllers\AdminController::class . '@view');
    Route::post('/menus/{id}', \OZiTAG\Tager\Backend\Menus\Controllers\AdminController::class . '@update');
    Route::delete('/menus/{id}', \OZiTAG\Tager\Backend\Menus\Controllers\AdminController::class . '@delete');

    Route::get('/menus/{id}/items', \OZiTAG\Tager\Backend\Menus\Controllers\AdminController::class . '@items');
    Route::put('/menus/{id}/items', \OZiTAG\Tager\Backend\Menus\Controllers\AdminController::class . '@createItem');
    Route::get('/menus/items/{id}', \OZiTAG\Tager\Backend\Menus\Controllers\AdminController::class . '@viewItem');
    Route::post('/menus/items/{id}', \OZiTAG\Tager\Backend\Menus\Controllers\AdminController::class . '@updateItem');
    Route::delete('/menus/items/{id}', \OZiTAG\Tager\Backend\Menus\Controllers\AdminController::class . '@deleteItem');
});
