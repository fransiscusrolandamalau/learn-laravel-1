<?php

use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Route;

// Route::get('/{any?}', function (){
//     return view('base');
// })->where('any', '^(?!api\/)[\/\w\.-]*');
Route::get('{path}', BaseController::class)->where('path', '(.*)');
