<?php
use App\Http\Controllers\dashboard\CategoryController;

Route::group([
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
    // 'middleware' => ['auth']],
], function () {
    Route::get('/categories/trashed', [CategoryController::class, 'trashed'])->name('categories.trashed');

    Route::resource('/categories', CategoryController::class);


});
Route::patch('/categories/{id}/restore', [CategoryController::class, 'restore'])->name('dashboard.categories.restore');
Route::delete('/categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('dashboard.categories.force-delete');
