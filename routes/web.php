<?php



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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/test', function(){
    return "Hello";
});

// Route::view('upload', 'uploadFile');

Route::get('upload', function () {
    return view("uploadFile");
})->middleware('auth');

Route::post('uploadfile','HomeController@uploadFilePost')->middleware('auth');

Route::get('/del', function(){
    Storage::disk('storage2')->delete('IMG_20191104_080220.jpeg');
});