@extends('layouts.app', ['title' => $project->name])

@section('content')
    @include('layouts.headers.title', ['title' => 'Settings', 'subtitle' => $project->name])

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h1 class="card-title">Coming Soon</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection