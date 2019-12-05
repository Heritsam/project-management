@extends('layouts.landing', ['title' => __('User Management')])

@section('content')
    @include('layouts.headers.title-landing', ['title' => 'List of Users'])

    <div class="container mt--7">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Users</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary">Add user</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered align-items-center table-flush" id="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>User Group</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                <a href="mailto:{{ $user->email }}" target="_blank">{{ $user->email }}</a>
                                            </td>
                                            <td>{{ $user->username }}</td>
                                            <td>
                                                <a href="{{ route('group.show', $user->group->id) }}">{{ $user->group->name }}</a>
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-primary btn-icon-only" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        @if ($user->id != auth()->id())
                                                            <form action="{{ route('user.destroy', $user) }}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                                
                                                                <a class="dropdown-item" href="{{ route('user.edit', $user) }}">Edit</a>
                                                                <button type="button" class="dropdown-item" onclick="confirm('Are you sure you want to delete this user?') ? this.parentElement.submit() : ''">
                                                                    {{ __('Delete') }}
                                                                </button>
                                                            </form>    
                                                        @else
                                                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Edit</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection