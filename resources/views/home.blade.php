@extends('layouts.app')

@section('content')
<div class="container">

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{$message}}</strong>
        </div>
    @endif
    <div class="row d-flex align-items-center">
        <div class="col-3">
            <a href='upload' class='btn btn-success my-3'>Upload New File</a>
        </div>
        <div class="col-6"></div>
        <div class="col-3">
            <form action="/search" method="POST" role="search">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" name="q"
                        placeholder="Search File"> <span class="input-group-btn">
                        <button type="submit" class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <div style="background-color:white; padding:10px; border-radius: 20px;">
        <h2 class="font-weight-bold">List Of Uploaded Files In System:</h2>
        <ul style="margin-top:20px;">
            
        </ul>
        <table class="table text-center"> 
            <thead>
                <tr>
                    <th>#</th>
                    <th>File Name</th>
                    <th>File Size</th>
                    <th>File Hash</th>
                    <th>Upload Date</th>
                    <th>Owner</th>
                    <th>Action</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $key => $file)
                    <tr>
                        <td class="text-success font-weight-bold">{{++$key}}</td>
                        <td class="text-success font-weight-bold">{{$file->file_name}}</td>
                        <td class="text-success font-weight-bold">{{$file->file_size}} Byte</td>
                        <td class="text-success font-weight-bold">{{$file->file_hash}}</td>
                        <td class="text-success font-weight-bold">{{$file->created_at}}</td>
                        @if (Auth::id() == $file->user_id)
                            <td class="text-primary font-weight-bold">
                                <span class="badge badge-primary">You</span>
                            </td>
                            <td>
                                <form method="post" action="/file/{{$file->id}}/delete">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                                </form>
                            </td>
                        @else
                            <td class="text-success font-weight-bold">{{\App\User::find($file->user_id)->name}}</td>
                            <td class="text-success font-weight-bold"></td>
                        @endif
                        <td>
                            <a style="color:white;" href="/file/{{$file->id}}/download" class="btn btn-success btn-sm" role="button">Download</a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
