<?php
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Middleware\CheckUserType;
Route::group([
    'middleware' => ['auth', CheckUserType::class],
    'prefix' => 'dashboard',
    'as' => 'dashboard.',

], function () {
    Route::get('/categories/trashed', [CategoryController::class, 'trashed'])->name('categories.trashed');

    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', \App\Http\Controllers\dashboard\ProductController::class);

});
Route::patch('/categories/{id}/restore', [CategoryController::class, 'restore'])->name('dashboard.categories.restore');
Route::delete('/categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('dashboard.categories.force-delete');
