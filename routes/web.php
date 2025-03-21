<?php

use App\Models\Property;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertysController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


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

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function(){
    Route::resource('property', PropertyController::class)->except(['show']);
    Route::resource('option', OptionController::class)->except(['show']);
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
