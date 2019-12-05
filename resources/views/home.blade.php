@extends('layouts.landing')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2 class="text-primary mb-0">Welcome Back</h2>
            <h1 class="display-2">{{ Auth::user()->name }}</h1>

            <div class="form-group my-3">

                <div class="input-group input-group-alternative">
                    <input type="search" name="keyword" id="keyword" class="form-control form-control-alternative" placeholder="Search for a project">

                    <div class="input-group-append">
                        <button class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center mt-5 mb-3">
                <h1>Recent Projects</h1>
                <a href="{{ route('project.create') }}" class="btn btn-success btn-icon ml-auto">
                    <span class="btn-inner--icon"><i class="ni ni-diamond"></i></span>
                    <span class="btn-inner--text">New project</span>
                </a>
            </div>
            <div class="row">
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

                @foreach ($projects as $p)
                    <div class="col-md-6">
                        <div class="card border shadow-sm mb-4">
                            <div class="card-body">
                                <h2 class="card-title">
                                    {{ $p->name }}

                                    @if ($p->date_due->diffInDays(now()) < 2)
                                        <span class="badge badge-danger">
                                            {{ $p->date_due->diffForHumans() }}
                                        </span>
                                    @elseif ($p->date_due->diffInDays(now()) < 7)
                                        <span class="badge badge-warning">
                                            {{ $p->date_due->diffForHumans() }}
                                        </span>
                                    @else
                                        <span class="badge badge-success">
                                            {{ $p->date_due->diffForHumans() }}
                                        </span>
                                    @endif
                                </h2>

                                <h5 class="card-subtitle text-muted">
                                    Started by <a href="">{{ $p->started_by->name }}</a>
                                </h5>
                                
                                <div class="row justify-content-center pt-5">
                                    <div class="col-md-4 text-center">
                                        <div class="icon icon-shape bg-gradient-blue text-white rounded-circle shadow icon-detail">
                                            <i class="fa fa-percentage"></i>
                                        </div>
                                        <div class="py-3">
                                            <span class="font-weight-bold">0%</span>
                                            Done
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow icon-detail">
                                            <i class="fa fa-project-diagram"></i>
                                        </div>
                                        <div class="py-3">
                                            {{ $p->timelines->count() . Str::plural(" Timeline", $p->timelines->count()) }}
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <div class="icon icon-shape bg-gradient-success text-white rounded-circle shadow icon-detail">
                                            <i class="fa fa-user-friends"></i>
                                        </div>
                                        <div class="py-3">
                                            {{ $p->contributors->count() . Str::plural(" Contributor", $p->contributors->count()) }}
                                        </div>
                                    </div>
                                </div>
    
                                <div class="d-flex align-items-baseline">
                                    <div class="mt-4">
                                        Due date
                                        @if ($p->date_due->diffInDays(now()) < 2)
                                            <span class="text-danger">
                                                {{ date('d M Y', strtotime($p->date_due)) }}
                                            </span>
                                        @elseif ($p->date_due->diffInDays(now()) < 7)
                                            <span class="text-warning">
                                                {{ date('d M Y', strtotime($p->date_due)) }}
                                            </span>
                                        @else
                                            <span class="text-success">
                                                {{ date('d M Y', strtotime($p->date_due)) }}
                                            </span>
                                        @endif
                                    </div>

                                    <a href="{{ route('project.show', $p->id) }}" class="btn btn-success bg-gradient-success ml-auto btn-icon goto">
                                        <span class="btn-inner--icon"><i class="ni ni-app"></i></span>
                                        <span class="btn-inner--text">
                                            Go to project
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    var toggle = false;
    var animationClass = 'pulse';

    $('.goto').hover(function() {
        toggle = !toggle;

        if (toggle) {
            $('.icon-detail').addClass(animationClass + " animated");
        } else {
            $('.icon-detail').removeClass(animationClass + " animated");
        }
    });
</script>
@endpush
