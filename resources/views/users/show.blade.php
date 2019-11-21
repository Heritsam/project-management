@extends('layouts.landing', ['title' => __('User Profile')])

@section('content')
    @include('layouts.headers.title-landing', [
        'title' => 'Hello ' . Auth::user()->name,
    ])

    <div class="container mt--7">
        <div class="row justify-content-center">
            <div class="col-xl-6 order-xl-2 mb-5 mb-xl-0">
                <div class="card card-profile shadow">
                    <div class="card-body pt-0 pt-md-4">
                        <div class="text-center mt-3">
                            <h2 class="card-title mb-3">{{ Auth::user()->name }}</h2>

                            <div class="card-subtitle text-primary">
                                {{ Auth::user()->user_group->name }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="heading">{{ Auth::user()->contributes->count() }}</span>
                                        <span class="description">{{ Str::plural('Contribute', Auth::user()->contributes->count()) }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">{{ Auth::user()->projects->count() }}</span>
                                        <span class="description">{{ Str::plural('Project', Auth::user()->contributes->count()) . " started" }}</span>
                                    </div>
                                    <div>
                                        <span class="heading">89</span>
                                        <span class="description">{{ __('Comments') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection