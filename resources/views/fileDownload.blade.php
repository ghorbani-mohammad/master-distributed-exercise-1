@extends('layouts.app')

@section('content')
<div class="container">
    <div style="background-color:white; padding:10px; border-radius: 20px;">
        <h2 class="font-weight-bold">List Of Partitions:</h2>
        <ul style="margin-top:20px;">
            
        </ul>
        <table class="table text-center"> 
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Size</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parts as $key => $part)
                    <tr>
                        <td class="text-success font-weight-bold">{{++$key}}</td>
                        <td class="text-success font-weight-bold">{{$part->partition}}</td>
                        <td class="text-success font-weight-bold">{{$part->size}} Byte</td>
                        <td>
                            <a style="color:white;" href="localhost:81/{{$file->file_dir}}/{{$part->partition}}" class="btn btn-primary btn-sm" role="button">Storage1</a>
                            <a style="color:white;" href="localhost:82/{{$file->file_dir}}/{{$part->partition}}" class="btn btn-secondary btn-sm" role="button">Storage2</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
