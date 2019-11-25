@extends('layouts.app', ['title' => $project->name])

@section('content')
    @include('layouts.headers.title', ['title' => 'Timeline', 'subtitle' => $project->name])

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header d-flex align-items-baseline">
                        <h4>Timelines</h4>

                        <a href="{{ route('timeline.create', $project->id) }}" class="btn btn-primary btn-sm ml-auto">
                            Add Timeline
                        </a>
                    </div>
                    
                    <div class="card-body">
                        <div class="list-group">
                            @foreach ($timelines as $t)
                                <a href="" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#addChildTimeline-{{ $t->id }}">
                                    {{ $loop->iteration }}. {{ $t->description }}

                                    <small class="{{ $t->status ? 'text-success' : 'text-danger' }}">
                                        ({{ $t->status() }})
                                    </small>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($timelines as $t)
        <!-- Modal -->
        <div class="modal fade" id="addChildTimeline-{{ $t->id }}" tabindex="-1" role="dialog" aria-labelledby="addChildTimeline-{{ $t->id }}Label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="modal-title-notification">Timeline</h4>
                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-body">
                        <div class="py-3 text-center">
                            <i class="fa fa-project-diagram fa-3x text-primary"></i>
                            <h4 class="heading mt-4">{{ $t->description }}</h4>
                            <p>
                                {{ date('d M Y', strtotime($t->date_start)) }} - {{ date('d M Y', strtotime($t->date_end)) }}
                            </p>
                        </div>

                        <table class="table">
                            <tr>
                                <th>Created By</th>
                                <td>
                                    {{ $t->started_by->name }} 
                                    <small class="text-primary">{{ "(" . $t->started_by->email . ")" }}</small>
                                </td>
                            </tr>
                            <tr>
                                <th>Assigned To</th>
                                <td>
                                    {{ $t->assigned_to->name }} 
                                    <small class="text-primary">{{ "(" . $t->assigned_to->email . ")" }}</small>
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td class="text-uppercase font-weight-bold mt-4 {{ $t->status ? 'text-success' : 'text-danger' }}">
                                    {{ $t->status() }}
                                </td>
                            </tr>
                            @if ($t->status)
                                <tr>
                                    <th>Date Done</th>
                                    <td>{{ date('d M Y', strtotime($t->date_done)) }}</td>
                                </tr>
                            @endif
                        </table>

                        <h4 class="mt-4">Comments</h4>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
