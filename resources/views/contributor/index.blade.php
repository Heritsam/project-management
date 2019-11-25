@extends('layouts.app', ['title' => $project->name])

@section('content')
    @include('layouts.headers.title', ['title' => 'Contributors', 'subtitle' => $project->name])

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header d-flex align-items-baseline">
                        <h4>Contributors</h4>

                        <button type="button" class="btn btn-primary btn-sm ml-auto" data-toggle="modal" data-target="#addContributor">
                            Add Contributor
                        </button>
                    </div>
                    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        
                        <div class="table-responsive">
                            <table class="table" id="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Group</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contributors as $c)
                                        <tr>
                                            <td>{{ $c->user->name }}</td>
                                            <td>{{ $c->user->email }}</td>
                                            <td>{{ $c->user->group->name }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a class="btn btn-primary btn-icon-only {{ $c->user->id == auth()->id() ? 'disabled' : '' }}" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                        <form action="{{ route('contributor.destroy', ['id' => $project->id, 'contrib_id' => $c->id]) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="button" class="dropdown-item" onclick="confirm('Are you sure you want to remove this user?') ? this.parentElement.submit() : ''">
                                                                Remove from project
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addContributor" tabindex="-1" role="dialog" aria-labelledby="addContributorLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addContributorLabel">Add Contributor</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('contributor.store', $project->id) }}" method="post">
                    @csrf
                    
                    <div class="modal-body">
                        <select name="user_id" id="select" class="form-control">
                            @foreach ($users as $u)
                                <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection