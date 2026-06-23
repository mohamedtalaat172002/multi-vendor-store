<?php
use App\Http\Controllers\dashboard\CategoryController;

Route::group([
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
   // 'middleware' => ['auth']],
  ],  function () {
        
    Route::resource('/categories', CategoryController::class);
});
