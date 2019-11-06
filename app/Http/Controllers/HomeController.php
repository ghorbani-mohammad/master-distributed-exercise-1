<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Log;
use App\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $files = File::all();
        return view('home', compact('files'));
    }

    public function uploadFilePost(Request $request)
    {
        $request->validate([
            'fileToUpload' => 'required|file',
        ]);

        Storage::disk('storage1')->putFileAs('', $request->fileToUpload, $request->fileToUpload->getClientOriginalName());
        Storage::disk('storage2')->putFileAs('', $request->fileToUpload, $request->fileToUpload->getClientOriginalName());
        auth()->user()->files()->create([
            'file_name' => $request->fileToUpload->getClientOriginalName(),
            'file_size' => 'sdjfl',
            'file_hash' => 'ljsljfls'
        ]);
    
        return back()->with('success','You have successfully uploaded the file.');
    }
}
