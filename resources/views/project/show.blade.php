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
        </div>
        
        <div class="card shadow">
            <div class="card-body">

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                
                <div class="row justify-content-center py-5">
                    <div class="col-md-4 text-center">
                        <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow">
                            <i class="fa fa-percentage"></i>
                        </div>
                        <div class="py-3">
                            <span class="font-weight-bold">
                                {{ $project->done_percentage() }}
                            </span>
                            Done
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                            <i class="fa fa-project-diagram"></i>
                        </div>
                        <div class="py-3">
                            {{ $project->timelines->count() . Str::plural(" Timeline", $project->timelines->count()) }}
                        </div>
                    </div>
                    <div class="col-md-4 text-center">
                        <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow">
                            <i class="fa fa-users"></i>
                        </div>
                        <div class="py-3">
                            {{ $project->contributors->count() . Str::plural(" Contributor", $project->contributors->count()) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mt-5 text-center">
            <form action="{{ route('project.destroy', $project->id) }}" method="post">
                @csrf
                @method('DELETE')

                
                @if ($project->started_by->id == Auth::user()->id)

                    {{-- @if (in_array(Auth::user()->id, $project->contributors->pluck('user_id')->toArray())) --}}
                        <a href="{{ route('project.edit', $project->id) }}" class="btn btn-link btn-icon">
                            <i class="fa fa-pen"></i> Edit Project
                        </a>
                    {{-- @endif --}}
                    
                    <button type="submit" class="btn btn-link text-danger btn-icon"
                        onclick="return confirm('Are you sure you want to delete this project? this action cannot be reverted')">
                        <i class="fa fa-trash"></i> Delete Project
                    </button>
                @endif
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('#dateStartNow').click(function() {
            var dateStart = document.getElementById('date_start');
            dateStart.value = "{{ now()->format('Y-m-d') }}";
        });

        $('#dateDueNow').click(function() {
            var dateDue = document.getElementById('date_end');
            dateDue.value = "{{ now()->format('Y-m-d') }}";
        });
    </script>
@endpush
