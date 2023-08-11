<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\SpamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//メインページ
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('User', 'UserController');
Route::resource('Post', 'PostController');
//違反報告
Route::resource('Spam', 'SpamController');

//依頼
Route::get('/jobask/{Post}', [DisplayController::class, 'index'])->name('jobask.index');
Route::post('/jobask/{Post}', [DisplayController::class, 'create'])->name('jobask.create');
//違反報告
Route::post('/spam/{Post}', [SpamController::class, 'spamCreate'])->name('spam.report');

//Route::post('/user_create/{user}', [UserController::class, 'createUser'])->name('create.user');


// method url                     function RouteName
// GET    /photos                 index    photos.index    一覧画面表示
// GET    /photos/create          create   photos.create　 新規登録画面表示
// POST   /photos                 store    photos.store　　新規登録処理
// GET    /photos/{photo}         show     photos.show　　 詳細画面表示
// GET    /photos/{photo}/edit    edit     photos.edit　　 編集画面表示
// PUT    /photos/{photo}         update   photos.update　 編集処理
// DELETE /photos/{photo}         destroy  photos.destroy　削除処理