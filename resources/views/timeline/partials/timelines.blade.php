<li class="list-group-item">
    <div class="d-flex">
        <div>
            {{ $loop->iteration }}. {{ $t->description }}
        
            <small class="{{ $t->status() == 'Done' ? 'text-success' : 'text-danger' }}">
                ({{ $t->status() }})
            </small>
        </div>
    
        <div class="btn-group ml-auto">
            <button type="button" class="btn btn-outline-success btn-icon" data-toggle="modal" data-target="#showTimeline-{{ $t->id }}" 
                onmouseover="$('#more_info{{ $t->id }}').show()"
                onmouseout="$('#more_info{{ $t->id }}').hide()">

                <span class="btn-inner--icon">
                    <i class="ni ni-air-baloon"></i>
                </span>
                <span class="btn-inner--text" id="more_info{{ $t->id }}">
                    More info
                </span>
            </button>

            <button type="button" class="btn btn-success btn-icon border-0 bg-gradient-success" data-toggle="modal" data-target="#addChildTimeline-{{ $t->id }}" 
                onmouseover="$('#add_child{{ $t->id }}').show()"
                onmouseout="$('#add_child{{ $t->id }}').hide()">
                <span class="btn-inner--icon">
                    <i class="ni ni-fat-add"></i>
                </span>
                <span class="btn-inner--text" id="add_child{{ $t->id }}">
                    Add child timeline
                </span>
            </button>
        </div>
    </div>

    @if ($t->children->isNotEmpty())
        <ul class="list-group mt-4">
            @foreach ($t->children as $c)
                @include('timeline.partials.timelines', ['t' => $c])
            @endforeach
        </ul>
    @endif
</li>