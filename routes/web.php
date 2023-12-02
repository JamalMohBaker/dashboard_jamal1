<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorAuthentcationController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Fortify;
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

// Route::get('/', function () {
//     return view('homePage');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
// Fortify::twoFactorChallengeView(function () {
//     return view('auth.two-factor-challenge');
// });


require __DIR__.'/dashboard.php';
// require __DIR__.'/auth.php';

