<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainController;
use DragonCode\Contracts\Cashier\Config\Main;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/locale/{loc}', function($loc){
//     session()->put('locale', $loc);
//     return redirect()->back();
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [MainController::class, 'index'])->middleware(['auth']);
Route::get('/admin',[MainController::class, 'admin'])->middleware(['auth','isVerify']);
Route::post('/filter', [MainController::class, 'filter']);
Route::get('/reconnect', [MainController::class, 'reconnect']);
Route::get('/banned/{id}',[MainController::class, 'banned'])->name('banned');
Route::get('/unbanned/{id}',[MainController::class, 'unbanned'])->name('unbanned');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
