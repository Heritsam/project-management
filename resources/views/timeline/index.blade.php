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

                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
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
        let projectStart = "{{ $project->date_start->format('Y-m-d') }}";
        let projectEnd = "{{ $project->date_due->format('Y-m-d') }}";
        
        let dateStart = document.getElementById('date_start');
        let dateEnd = document.getElementById('date_end');

        dateStart.min = projectStart;
        dateStart.max = projectEnd;

        $('#date_start').change(function() {
            dateEnd.min = dateStart.value;
            dateEnd.max = projectEnd;

            if (dateEnd.value < dateStart.value) {
                dateEnd.value = dateStart.value;
            }
        });
    </script>

    <script>
        @foreach ($timelines as $t)
            $('#more_info{{ $t->id }}').hide();
            $('#add_child{{ $t->id }}').hide();
        @endforeach
    </script>
@endpush
