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
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        
                        @if ($timelines->isNotEmpty())
                            <div class="list-group">
                                @foreach ($timelines as $t)
                                    <a href="" class="list-group-item list-group-item-action" data-toggle="modal" data-target="#showTimeline-{{ $t->id }}">
                                        {{ $loop->iteration }}. {{ $t->description }}

                                        <small class="{{ $t->status ? 'text-success' : 'text-danger' }}">
                                            ({{ $t->status() }})
                                        </small>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center text-danger">
                                No timelines available in the projects.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('timeline.partials.modals', ['timelines' => $timelines])
@endsection

@push('js')
    <script>
        $('#dateStartNow').click(function() {
            var dateStart = document.getElementById('date_start');
            dateStart.value = "{{ now()->format('Y-m-d') }}";
        });

        $('#dateEndNow').click(function() {
            var dateDue = document.getElementById('date_end');
            dateDue.value = "{{ now()->format('Y-m-d') }}";
        });
    </script>
@endpush
