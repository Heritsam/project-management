@extends('layouts.landing', ['title' => __('Projects')])

@section('content')
    @include('layouts.headers.title-landing', ['title' => 'New Project'])

    <div class="container mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow-sm">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">New Project</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('project.store') }}" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Project information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="name">Name</label>
                                    
                                    <input type="text" name="name" id="name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ old('name') }}" required autofocus>

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

                                            <div class="input-group input-group-alternative">
                                                <input type="text" name="date_start" id="date_start" class="datepicker form-control form-control-alternative{{ $errors->has('date_start') ? ' is-invalid' : '' }}" placeholder="Select date" value="{{ old('date_start') }}" data-date-format="yyyy-mm-dd" required autofocus>

                                                <div class="input-group-append">
                                                    <div id="dateStartNow" class="btn btn-link">Now</div>
                                                </div>
                                            </div>
                                            
        
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

                                            <div class="input-group input-group-alternative">
                                                <input type="text" name="date_due" id="date_due" class="datepicker form-control form-control-alternative{{ $errors->has('date_due') ? ' is-invalid' : '' }}" placeholder="Select Date" value="{{ old('date_due') }}" data-date-format="yyyy-mm-dd" required autofocus>

                                                <div class="input-group-append">
                                                    <div class="input-group-append">
                                                        <div id="dateDueNow" class="btn btn-link">Now</div>
                                                    </div>
                                                </div>
                                            </div>
                                            
        
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
                                    <button type="submit" class="btn btn-success mt-4">SAVE</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script>
        $('#dateStartNow').click(function() {
            var dateStart = document.getElementById('date_start');
            dateStart.value = "{{ now()->format('Y-m-d') }}";
        });

        $('#dateDueNow').click(function() {
            var dateDue = document.getElementById('date_due');
            dateDue.value = "{{ now()->format('Y-m-d') }}";
        });
    </script>
@endpush