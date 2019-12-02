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
                            <ul class="list-group">
                                @foreach ($timelines->toTree() as $t)
                                    @include('timeline.partials.timelines', $t)
                                @endforeach
                            </ul>
                        @else
                            @include('timeline.partials.timeline-none')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('timeline.partials.modals', ['timelines' => $timelines->toFlatTree()])
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
