<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/', function(){
    return view('index');
});
Route::get('about', function(){
    return view('about');
});
Route::get('blog', [AdminController::class,'blog']);
Route::get('about', [AdminController::class,'about']);
Route::get('delete/{id}', [AdminController::class,'delete']);
Route::post('insert', [AdminController::class, 'insert']);
Route::get('create', [AdminController::class, 'create']);
Route::get('edit/{id}', [AdminController::class, 'edit']);
Route::post('update/{id}', [AdminController::class, 'update']);


