@extends('layouts.landing', ['title' => __('User Management')])

@section('content')
    @include('layouts.headers.title-landing', ['title' => 'Edit User'])

    <div class="container mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Edit User</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('user.update', $user) }}" autocomplete="off">
                            @csrf
                            @method('PUT')
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Name" value="{{ $user->name }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="username">Username</label>
                                    
                                    <input type="text" name="username" id="username" class="form-control form-control-alternative{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="Username" value="{{ $user->username }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="email">Email</label>
                                    <input type="email" name="email" id="email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ $user->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('user_group_id') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="user_group_id">User Group</label>

                                    <select name="user_group_id" id="user_group_id" class="form-control form-control-alternative{{ $errors->has('user_group_id') ? ' is-invalid' : '' }}" placeholder="wayoo">
                                        @foreach ($user_groups as $r)
                                            <option {{ $user->user_group_id == $r->id ? 'selected' : '' }} value="{{ $r->id }}">{{ $r->name }}</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('user_group_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('user_group_id') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <input type="hidden" name="status" value="1">
                            </div>

                            <h6 class="heading-small text-muted mb-4">
                                Change Password (Optional)
                            </h6>
                            
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="password">{{ __('Password') }}</label>
                                    <input type="password" name="password" id="password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="">
                                    
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label" for="password_confirmation">{{ __('Confirm Password') }}</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm Password') }}" value="">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success mt-4">SAVE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection