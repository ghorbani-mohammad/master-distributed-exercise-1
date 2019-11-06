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
    <div style="background-color:white; padding:10px; border: 1px solid #dcdcdc;">
        <span>List Of Uploads:</span>
        <ul style="margin-top:10px;">
            <li class="text-success font-weight-bold">readme1.txt</li>
            <li class="text-success font-weight-bold">readme2.txt</li>
            <li class="text-success font-weight-bold">readme3.txt</li>
        </ul>
    </div>
</div>
@endsection
