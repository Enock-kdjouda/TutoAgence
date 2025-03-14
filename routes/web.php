<?php

use App\Models\Property;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertysController;
use App\Http\Controllers\AuthController;



$idRegex = '[0-9]+';
$slugRegex = '[0-9a-z\-]+';
Route::get('/', [HomeController::class, 'index']);
Route::get('/biens', [PropertysController::class, 'index'])->name('property.index');
Route::get('/biens/{slug}-{property}', [PropertysController::class, 'show'])->name('property.show')->where([
    'property' => $idRegex,
    'slug' => $slugRegex
]);
Route::post('/biens/{property}/contact', [PropertysController::class, 'contact'])->name('property.contact')->where([
    'property' => $idRegex,
    
]);
Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('auth.login');
Route::post('/login', [AuthController::class,'doLogin']);
Route::delete('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('auth.logout');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function(){
    Route::resource('property', PropertyController::class)->except(['show']);
    Route::resource('option', OptionController::class)->except(['show']);
});      

