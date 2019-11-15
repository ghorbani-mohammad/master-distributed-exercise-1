<?php

use App\File_Partition;


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

Route::get('upload', function () {
    return view("uploadFile");
})->middleware('auth');

Route::post('uploadfile','HomeController@uploadFilePost')->middleware('auth');

Route::get('file/{id}/download', function($id){
    $file = App\File_Resource::where('id', $id)->first();
    $parts = File_Partition::where('file__resource_id', $id)->select('partition', 'size')->get()->unique('partition');
    return view('fileDownload', compact('parts', 'file'));
});

Route::get('file/{id}/delete', function($id){
    $file = App\File_Resource::where('id', $id)->first();
    // return $file;
    if(Auth::id()==$file->user_id){
        Storage::disk('storage1')->delete($file->file_dir);        
        Storage::disk('storage2')->delete($file->file_dir);
        $file->file_partitions()->delete();
        $file->delete();
        
    }
    return $id;
})->middleware('auth');

Route::post('search', fucntion(){

});