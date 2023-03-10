<?php

use App\File_Partition;
use App\File_Resource;


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

Auth::routes();






// GET Requests

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('upload', function () {
    return view("uploadFile");
})->middleware('auth');

Route::get('file/{id}/download', function($id){
    $file = File_Resource::where('id', $id)->first();
    $parts = File_Partition::where('file__resource_id', $id)->get()->unique('partition');
    return view('fileDownload', compact('parts', 'file'));
});



// POST Requests

Route::post('uploadfile','HomeController@uploadFilePost')->middleware('auth');

Route::post('search', function(){
    $query = request()['q'];

    // Using LIKE command for search
    $files = File_Resource::where('file_name','LIKE','%'.$query.'%')->get();
    return view('searchResult', compact('files'));
});



// DELETE Request

Route::delete('file/{id}/delete', function($id){
    $file = File_Resource::where('id', $id)->first();

    // Checking if the user is owner of the file
    if(Auth::id()==$file->user_id){
        Storage::disk('storage1')->delete($file->file_dir);        
        Storage::disk('storage2')->delete($file->file_dir);
        $file->file_partitions()->delete();
        $file->delete();
    }
    return redirect('/home')->with('success','You have successfully Deleted the file.');
})->middleware('auth');

