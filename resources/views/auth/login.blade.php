@extends('layouts.app', ['class' => 'bg-gradient-primary'])

@section('content')
    <div class="container">
        <div class="row h-100vh d-flex align-items-center justify-content-center">
            <div class="col-lg-5 col-md-6">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="mb-4">
                            <h1 class="display-2 my-0">Login</h1>
                            <span class="text-muted">{{ config('app.name') }}</span>
                        </div>

                        <form role="form" method="POST" action="{{ route('login') }}" autocomplete="off">
                            @csrf

                            <div class="form-group{{ $errors->has('username') ? ' has-danger' : '' }} mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                    </div>

                                    <input class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="Username or Email" type="text" name="username" value="{{ old('username') }}" required autofocus>
                                </div>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>

                                    <input id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" required>

                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <button id="togglePassword" class="btn btn-sm btn-link shadow-none" type="button">
                                                Show
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customCheckLogin">
                                    <span class="text-muted">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success bg-gradient-success border-0 btn-block my-4">{{ __('Sign in') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="my-2 px-2 text-right">
                    <a href="{{ route('password.request') }}" class="text-white">
                        <small>Forgot Password?</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        var togglePassword = $('#togglePassword');

        togglePassword.click(function() {
            var inputPassword = document.getElementById("password");
            var buttonVisibility = document.getElementById("togglePassword");
            
            if (inputPassword.type === "password") {
                inputPassword.type = "text";
                buttonVisibility.innerHTML = "Hide";
            } else {
                inputPassword.type = "password";
                buttonVisibility.innerHTML = "Show";
            }
        });
    </script>
@endpush
