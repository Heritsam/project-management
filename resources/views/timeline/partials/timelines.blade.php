<li class="list-group-item">
    <div class="d-flex">
        <div>
            {{ $loop->iteration }}. {{ $t->description }}
        
            <small class="{{ $t->status() == 'Done' ? 'text-success' : 'text-danger' }}">
                ({{ $t->status() }})
            </small>
        </div>
    
        <button type="button" class="btn btn-success btn-icon border-0 bg-gradient-success ml-auto" data-toggle="modal" data-target="#showTimeline-{{ $t->id }}">
            <span class="btn-inner--icon">
                <i class="ni ni-air-baloon"></i>
            </span>
            <span class="btn-inner--text">
                More info
            </span>
        </button>
    </div>

    @if ($t->children->isNotEmpty())
        <ul class="list-group mt-4">
            @foreach ($t->children as $c)
                @include('timeline.partials.timelines', ['t' => $c])
            @endforeach
        </ul>
    @endif
</li>