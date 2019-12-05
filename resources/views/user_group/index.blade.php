@extends('layouts.landing', ['title' => __('User Group')])

@section('content')
    @include('layouts.headers.title-landing', ['title' => 'List of Groups'])

    <div class="container mt--7">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Groups</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('group.create') }}" class="btn btn-sm btn-primary">Add group</a>
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
                            <table class="table table-bordered table-hover align-items-center table-flush" id="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Users count</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groups as $group)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ route('group.show', $group->id) }}">{{ $group->name }}</a>
                                            </td>
                                            <td>{{ $group->users->count() }}</td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a class="btn btn-primary btn-icon-only {{ $group->name == 'Administrator' ? 'disabled' : '' }}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <form action="{{ route('group.destroy', $group) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            
                                                            <a class="dropdown-item" href="{{ route('group.edit', $group) }}">Edit</a>

                                                            <button type="button" class="dropdown-item" onclick="confirm('Are you sure you want to delete this group?') ? this.parentElement.submit() : ''">
                                                                Delete
                                                            </button>
                                                        </form>
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