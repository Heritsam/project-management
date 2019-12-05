@extends('layouts.landing', ['title' => __('User Group')])

@section('content')
    @include('layouts.headers.title-landing', ['title' => 'Group Information', 'subtitle' => $group->name])

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-xl-8 order-xl-1">
                <div class="card shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0"><span class="text-muted">Group |</span> List of Users in {{ $group->name }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ url()->previous() }}" class="btn btn-sm btn-primary">Back</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($group->users->isNotEmpty())
                                    @foreach ($group->users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                <a href="mailto:{{ $user->email }}" target="_blank">{{ $user->email }}</a>
                                            </td>
                                            <td>{{ $user->username }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4" align="center">
                                            <div class="text-danger mb-2">No users found</div>
                                            <a href="{{ route('user.create') }}" class="btn btn-success btn-sm">Add one instead</a>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection