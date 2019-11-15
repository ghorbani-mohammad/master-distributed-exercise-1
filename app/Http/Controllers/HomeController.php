<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
use Log;
use App\File_Resource;
use App\File_Partition;
use Illuminate\Http\UploadedFile;

use finfo;

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
        $files = File_Resource::all();
        return view('home', compact('files'));
    }

    public function uploadFilePost(Request $request)
    {
        $request->validate([
            'fileToUpload' => 'required|file',
        ]);
        $result = array();
        $random_dir = substr(md5(mt_rand()), 0, 20);
        // Log::info($random_dir);
        exec("mkdir ".$random_dir);
        Storage::disk('local')->putFileAs('temp_storage', $request->fileToUpload, $request->fileToUpload->getClientOriginalName());
        $stored_file = auth()->user()->files()->create([
            'file_name' => $request->fileToUpload->getClientOriginalName(),
            'file_size' => $request->file('fileToUpload')->getSize(),
            'file_hash' => hash_file('md5', $request->fileToUpload),
            'file_dir' =>$random_dir,
        ]);
        // Log::info($stored_file->id);
        $command_string = 'split  -b 2M /var/www/storage/app/temp_storage/'.$request->fileToUpload->getClientOriginalName().' ./'.$random_dir.'/file';
        exec($command_string);
        exec('cd ./'.$random_dir.'; ls', $partition_list);

        foreach ($partition_list as $partition) {

            $file_path = './'.$random_dir.'/'.$partition;
            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $uploadedFile = NULL;
            if (Storage::disk('local2')->exists('./'.$random_dir.'/'.$partition)) {
                $uploadedFile = new UploadedFile(
                    $file_path,
                    $partition,
                    $finfo->file($file_path),
                    filesize($file_path),
                    0,
                    false
                );
            }

            Storage::disk('storage1')->putFileAs($random_dir, $uploadedFile, $partition);
            Log::info($file_path);
            Log::info(hash_file('md5', $file_path));
            $stored_file->file_partitions()->create([
                'partition' => $partition,
                'storage' => 'storage1',
                'dir' => $random_dir,
                'size' => $uploadedFile->getSize(),
                'hash' => hash_file('md5', $file_path),
            ]);
            Storage::disk('storage2')->putFileAs($random_dir, $uploadedFile, $partition);
            $stored_file->file_partitions()->create([
                'partition' => $partition,
                'storage' => 'storage2',
                'dir' => $random_dir,
                'size' => $uploadedFile->getSize(),
                'hash' => hash_file('md5', $file_path),
            ]);
        }

        
        return redirect('/home');
        return back()->with('success','You have successfully uploaded the file.');
    }
}
