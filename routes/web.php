<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'front\WelcomeController@index')->name('welcome');
// Route::get('/about', 'front\WelcomeController@about')->name('about');
// Route::get('/kelas', 'front\KelasController@index')->name('kelas');
// Route::get('/kelas/detail/{id}', 'front\KelasController@detail')->name('kelas.detail');
// Route::get('/kelas/belajar/{id}/{idvideo}', 'front\KelasController@belajar')->name('kelas.belajar');
// Route::get('/podcast', 'front\PodcastController@index')->name('podcast');
// Route::get('/podcast/detail/{id}', 'front\PodcastController@detail')->name('podcast.detail');
// Route::get('/blog', 'front\BlogController@index')->name('blog');
// Route::get('/blog/detail/{id}', 'front\BlogController@detail')->name('blog.detail');

Route::group(['middleware' => ['auth', 'checkRole:regular,premium']], function () {
    Route::get('/upgradepremium', 'front\TransaksiController@index')->name('upgradepremium');
    Route::post('/uploadbukti', 'front\TransaksiController@uploadbukti')->name('uploadbukti');
    Route::post('/uploadulang', 'front\TransaksiController@uploadulang')->name('uploadulang');

    Route::get('/akun', 'front\AkunController@index')->name('akun');
    Route::get('/akun/editprofil', 'front\AkunController@editprofil')->name('akun.editprofil');
    Route::post('/akun/simpaneditprofil', 'front\AkunController@simpaneditprofil')->name('akun.simpaneditprofil');
    Route::get('/akun/editkatasandi', 'front\AkunController@editkatasandi')->name('akun.editkatasandi');
    Route::post('/akun/simpaneditkatasandi', 'front\AkunController@simpaneditkatasandi')->name('akun.simpaneditkatasandi');

});
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::get('/admin/dashboard', function () {
    return view('admin.dashboard', [
        'title' => 'Dashboard'
    ]);
    })->name('admin.dashboard');



Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {

    Route::get('/admin', 'admin\DashboardController@index')->name('admin');

    //User
    Route::get('/admin/user', 'admin\UserController@index')->name('admin.user');

    
});

// Auth::routes();
