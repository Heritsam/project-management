@extends('layouts.app', ['title' => $project->name])

@section('content')
    @include('layouts.headers.title', ['title' => 'Create Master Timeline', 'subtitle' => $project->name])

    <div class="container-fluid mt--7">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white d-flex align-items-baseline">
                        <h4>Create Master Timelines</h4>

                        <a href="{{ route('timeline.index', $project->id) }}" class="btn btn-primary btn-sm ml-auto">
                            Back
                        </a>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{ route('timeline.store', $project->id) }}" method="post" autocomplete="off">
                            @csrf

                            <div class="form-group">
                                <label for="description">Description</label>
                                
                                <input type="text" name="description" id="description" class="form-control form-control-alternative" placeholder="Daftar Approval Perbaikan
                                " required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('date_start') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="date_start">Date Start</label>

                                        <input type="date" name="date_start" id="date_start" class="form-control form-control-alternative{{ $errors->has('date_start') ? ' is-invalid' : '' }}" value="{{ old('date_start') }}" required>
                                        
                                        @if ($errors->has('date_start'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date_start') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('date_end') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="date_end">Date End</label>

                                        <input type="date" name="date_end" id="date_end" class="form-control form-control-alternative{{ $errors->has('date_end') ? ' is-invalid' : '' }}" value="{{ old('date_end') }}" required>
    
                                        @if ($errors->has('date_end'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date_end') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="user_assign_id">Assign to</label>

                                <select name="user_assign_id" id="select" class="form-control form-control-alternative">
                                    @foreach ($project->contributors as $c)
                                        <option value="{{ $c->user->id }}">{{ $c->user->name }} ({{ $c->user->email }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Create timeline</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('#dateStartNow').click(function() {
            var dateStart = document.getElementById('date_start');
            dateStart.value = "{{ now()->format('Y-m-d') }}";
        });

        $('#dateEndNow').click(function() {
            var dateDue = document.getElementById('date_end');
            dateDue.value = "{{ now()->format('Y-m-d') }}";
        });
    </script>
@endpush
