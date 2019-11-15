@extends('layouts.app')

@section('content')
<div class="container">
    <!-- <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div> -->
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
                        <td class="text-success font-weight-bold">{{$file->created_at}}</td>
                        @if (Auth::id() == $file->user_id)
                            <td class="text-primary font-weight-bold">
                                <span class="badge badge-primary">You</span>
                            </td>
                            <td>
                                <!-- <button type="button" class="btn btn-danger btn-sm">Delete</button> -->
                                <a style="color:white;" href="/file/{{$file->id}}/delete" class="btn btn-danger btn-sm" role="button">Delete</a>
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
