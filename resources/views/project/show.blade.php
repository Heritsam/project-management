@extends('layouts.app', ['title' => $project->name])

@section('content')
    @include('layouts.headers.title', ['title' => 'Project Overview', 'subtitle' => $project->name])

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="card card-stats shadow border-0 mb-4 mb-lg-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Overall</h5>
                                <span class="h2 font-weight-bold mb-0">
                                    {{ $project->done_percentage() }}
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                                    <i class="fa fa-percentage"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="text-nowrap">Out of</span>
                            <span class="text-success mr-2">
                                {{ $project->timelines->count() }} Timelines
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card card-stats shadow border-0 mb-4 mb-lg-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Timelines</h5>
                                <span class="h2 font-weight-bold mb-0">
                                    {{ $project->timelines->count() . Str::plural(" Timeline", $project->timelines->count()) }}
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-danger text-white rounded-circle shadow">
                                    <i class="fa fa-project-diagram"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="text-success mr-2">
                                {{ $project->timelines->where('date_done', '!=', null)->count() . "/" . $project->timelines->count() }}
                            </span>
                            <span class="text-nowrap">Timelines done</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card card-stats shadow border-0 mb-4 mb-lg-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title text-uppercase text-muted mb-0">Contributors</h5>
                                <span class="h2 font-weight-bold mb-0">
                                    {{ $project->contributors->count() . Str::plural(" Contributor", $project->contributors->count()) }}
                                </span>
                            </div>
                            <div class="col-auto">
                                <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                                    <i class="fa fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <p class="mt-3 mb-0 text-muted text-sm">
                            <span class="text-nowrap">Started by</span>
                            <span class="text-success mr-2">
                                {{ $project->started_by->name }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>

            <div class="col-md-8">
                <div class="card bg-gradient-default shadow">
                    <div class="card-body">
                        <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                        <h2 class="text-white">Contributes</h2>
                        
                        <div id="chart">
                            {!! $chart->container() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-white shadow">
                    <div class="card-body">
                        <h6 class="text-uppercase text-light ls-1 mb-1">Overall</h6>
                        <h2 class="text-black">Total Timelines</h2>

                        <div id="chart">
                            {!! $pieChart->container() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
{!! $chart->script() !!}
{!! $pieChart->script() !!}
@endpush
