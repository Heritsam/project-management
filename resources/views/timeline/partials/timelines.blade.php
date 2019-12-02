<li class="list-group-item">
    {{ $loop->iteration }}. {{ $t->description }}

    <small class="{{ $t->status ? 'text-success' : 'text-danger' }}">
        ({{ $t->status() }})
    </small>

    <button type="button" class="btn btn-primary bg-gradient-primary btn-sm ml-3" data-toggle="modal" data-target="#showTimeline-{{ $t->id }}">
        <i class="ni ni-send"></i>
    </button>

    @if ($t->children->isNotEmpty())
        <ul class="list-group mt-4">
            @foreach ($t->children as $c)
                @include('timeline.partials.timelines', ['t' => $c])
            @endforeach
        </ul>
    @endif
</li>