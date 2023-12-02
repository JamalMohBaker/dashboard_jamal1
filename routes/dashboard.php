<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\LinksController;
use App\Http\Controllers\Logfile;
use App\Http\Controllers\TilesController;
use App\Http\Controllers\UsersController;
use App\View\Components\News\Notifications;
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TwoFactorAuthentcationController;
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth')->group(function () {
    Route::get('/auth/user/2fa',[TwoFactorAuthentcationController::class, 'index'])
        ->name('2fa');
    // Route::get('/auth/user/confirmed2fa',[HomePageController::class, 'confirmed2fa'])
    //     ->name('confirmed2fa');
        Route::put('/users/updatescan/{user}' , [UsersController::class , 'updatescan2fa'])
        ->name('updatescan2fa');
});
Route::middleware('auth','2fa')->group(function () {
    Route::get('/addlinks' , [HomePageController::class, 'index'])->name('addlinks');
    Route::get('/' , [LinksController::class, 'homepage'])->name('/');
    Route::get('/notifications', [Notifications::class, 'combinedView'])->name('notifications');

});

Route::middleware(['auth','2fa'])->group(function () {

    Route::get('/links/index/{tile_id}', [LinksController::class, 'index1'])
    ->name('links.index1');
    Route::get('/news/all', [HomePageController::class, 'getnews'])
     ->name('news.getnews');

    Route::get('/links/usrsAcc', [LinksController::class, 'userAcc'])
    ->name('links.usrsAcc');
    Route::get('/links/createLink/{id}' , [LinksController::class , 'createLink'])
    ->name('links.createLink');
    Route::get('/user/Recoverycode/{id}' , [HomePageController::class, 'getrecoverycode'])
    ->name('users.getrecoverycode');
    Route::put('/links/{link}/restore' , [ LinksController::class, 'restore'])
        ->name('links.restore');
    Route::resource('/links', LinksController::class);
});

Route::middleware(['auth', 'auth.type:admin,user_management','2fa'])->group(function () {


Route::get('/admin/users/trashed' , [UsersController::class , 'trashed'])
->name('users.trashed');
Route::post('/admin/news/add' , [HomePageController::class , 'store'])
->name('news.store');
Route::delete('/news/delete/{id}', [HomePageController::class, 'destroy'])
     ->name('news.destroy');
// Route::get('/admin/tiles/trashed' , [TilesController::class , 'trashed'])
// ->name('tiles.trashed');
// Route::delete('/users/{user}/force' , [UsersController::class , 'forceDelete'])
//                 ->name('users.force-delete');

Route::put('/admin/users/updatepass/{user}' , [UsersController::class , 'updatepass'])
    ->name('users.updatepass');
Route::put('/admin/users/{user}/restore' , [UsersController::class , 'restore'])
->name('users.restore');
Route::put('/admin/tiles/{tile}/restore' , [ TilesController::class, 'restore'])
->name('tiles.restore');


    Route::get('/users/{user}/editpass' , [UsersController::class , 'editpass'])
    ->name('users.editpass');
Route::resource('/admin/users', UsersController::class);
Route::resource('/admin/tiles', TilesController::class);
Route::get('/admin/logfiles/index' , [Logfile::class , 'index'])
->name('logfiles.index');
Route::delete('/logfiles/delete/{id}', [Logfile::class, 'destroy'])
     ->name('logfiles.destroy');
});
Route::middleware(['auth'])->group(function () {
    Route::resource('/user/profile', ProfileController::class);
});
