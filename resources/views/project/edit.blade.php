@extends('layouts.app', ['title' => __('Projects')])

@section('content')
    @include('layouts.headers.title', ['title' => 'Project Settings', 'subtitle' => $project->name])

    <div class="container-fluid mt--7">

        @if (in_array(Auth::user()->id, $project->contributors->pluck('user_id')->toArray()))
            <div class="row justify-content-center">
                <div class="col-md-8 mb-4">
                    <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <h3 class="mb-0">General</h3>
                        </div>

                        <div class="card-body">
                            <form method="post" action="{{ route('project.update', $project->id) }}" autocomplete="off">
                                @csrf
                                @method('PUT')
                                
                                <h6 class="heading-small text-muted mb-4">{{ __('Project information') }}</h6>
                                
                                <div class="pl-lg-4">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="name">Project name</label>
                                        
                                        <input type="text" name="name" id="name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ $project->name }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('date_start') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="date_start">Date Start</label>

                                                <input type="date" name="date_start" id="date_start" class="form-control form-control-alternative{{ $errors->has('date_start') ? ' is-invalid' : '' }}" value="{{ $project->date_start->format('Y-m-d') }}" required>
            
                                                @if ($errors->has('date_start'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('date_start') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('date_due') ? ' has-danger' : '' }}">
                                                <label class="form-control-label" for="date_due">Date Due</label>

                                                <input type="date" name="date_due" id="date_due" class="form-control form-control-alternative{{ $errors->has('date_due') ? ' is-invalid' : '' }}" value="{{ $project->date_due->format('Y-m-d') }}" max="" required>
                                                
                                                @if ($errors->has('date_due'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('date_due') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="status" value="1">
                                    <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="updated_by" value="{{ Auth::user()->id }}">

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success my-4">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @if ($project->started_by->id == Auth::user()->id)
                    <div class="col-md-8">
                        <div class="card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <h3 class="text-danger mb-0">Remove project</h3>
                            </div>

                            <div class="card-body">
                                <div class="d-flex align-items-baseline">
                                    <strong>Removed projects cannot be restored!</strong>

                                    <a href="#" class="btn btn-danger ml-auto" data-toggle="modal" data-target="#removeProject">
                                        Remove project
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow border-0">
                        <div class="card-body text-center">
                            <h2>You don't have access to edit this project</h2>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Modal -->
    <div class="modal fade" id="removeProject" tabindex="-1" role="dialog" aria-labelledby="removeProjectLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="mb-0">Confirmation</h3>
                </div>
                
                <div class="modal-body">
                    <p class="text-danger font-weight-bold">You are going to remove {{ $project->name }}.</p>
                    <p><strong>Removed projects cannot be restored!</strong></p>

                    <div class="form-group">
                        <label for="project_name">Please type <span class="text-primary font-weight-bold">{{ $project->name }}</span> to proceed</label>
                        
                        <input type="text" name="project_name" id="project_name" class="form-control">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <form action="{{ route('project.destroy', $project->id) }}" method="post" class="ml-auto">
                        @csrf
                        @method('DELETE')
                        
                        @if ($project->started_by->id == Auth::user()->id)
                            <button type="submit" id="remove_button" class="btn btn-danger btn-icon" disabled>
                                Confirm
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        let dateStart = document.getElementById('date_start');
        let dateDue = document.getElementById('date_due');
        
        dateDue.min = dateStart.value;

        let inputProject = document.getElementById('project_name');
        let removeButton = document.getElementById('remove_button');


        $('#project_name').keyup(function() {
            if (inputProject.value == "{{ $project->name }}") {
                removeButton.disabled = false;
            } else {
                removeButton.disabled = true;
            }
        });
    </script>
@endpush