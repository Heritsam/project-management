@foreach ($timelines as $t)
    <!-- Modal -->
    <div class="modal fade" id="showTimeline-{{ $t->id }}" tabindex="-1" role="dialog" aria-labelledby="showTimeline-{{ $t->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-notification">Timeline</h4>

                    <div class="dropdown">
                        <a class="btn btn-primary bg-gradient-primary btn-icon-only rounded-circle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <form action="{{ route('timeline.destroy', ['id' => $project->id, 'timeline_id' => $t->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                
                                <a class="dropdown-item" href="{{ route('timeline.edit', ['id' => $project->id, 'timeline_id' => $t->id]) }}">Edit</a>

                                <button type="button" class="dropdown-item" onclick="confirm('Are you sure you want to delete this timeline?') ? this.parentElement.submit() : ''">
                                    {{ __('Delete') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="fa fa-project-diagram fa-3x text-primary"></i>
                        <h4 class="heading mt-4">{{ $t->description }}</h4>
                        <p>
                            {{ date('d M Y', strtotime($t->date_start)) }} - {{ date('d M Y', strtotime($t->date_end)) }}
                        </p>

                        <a href="#" class="btn btn-success bg-gradient-success btn-sm mb-3" data-toggle="modal" data-target="#addChildTimeline-{{ $t->id }}">
                            Add another timeline
                        </a>
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

                    <div class="bg-secondary rounded px-3 py-3">
                        <form action="{{ route('timeline.comment.store', ['id' => $project->id, 'timeline_id' => $t->id]) }}" method="post">
                            @csrf

                            <textarea name="message" id="message" rows="4" class="form-control form-control-alternative" placeholder="Something..."></textarea>

                            <div class="text-right mt-4">
                                <button type="submit" class="btn btn-success">Comment</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@foreach ($timelines as $t)
    <!-- Modal for add another timeline -->
    <div class="modal fade" id="addChildTimeline-{{ $t->id }}" tabindex="-1" role="dialog" aria-labelledby="addChildTimeline-{{ $t->id }}Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title-notification">Add Child Timeline</h4>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <form action="{{ route('timeline.child.store', $project->id) }}" method="post" autocomplete="off">
                    @csrf

                    <input type="hidden" name="timeline_id" value="{{ $t->id }}">

                    <div class="modal-body">
                        <h5 class="text-muted">Parent timeline</h5>
                        <div class="py-3 text-center">
                            <i class="fa fa-project-diagram fa-3x text-primary"></i>
                            <h4 class="heading mt-4">{{ $t->description }}</h4>
                            <p>
                                {{ date('d M Y', strtotime($t->date_start)) }} - {{ date('d M Y', strtotime($t->date_end)) }}
                            </p>
                        </div>

                        <h5 class="text-muted">Child timeline</h5>
                        <div class="bg-secondary rounded px-3 py-3">
                            <div class="form-group">
                                <label for="description">Description</label>

                                <input type="text" name="description" id="description" class="form-control form-control-alternative" value="{{ old('description') }}" placeholder="Push source code ke github" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('date_start') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="date_start">Date Start</label>

                                        <input type="date" name="date_start" id="date_start" class="form-control form-control-alternative{{ $errors->has('date_start') ? ' is-invalid' : '' }}" value="{{ old('date_start') }}" required>
                                        
    
                                        @if ($errors->has('date_start'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date_start') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group{{ $errors->has('date_end') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="date_end">Date End</label>

                                        <input type="date" name="date_end" id="date_end" class="form-control form-control-alternative{{ $errors->has('date_end') ? ' is-invalid' : '' }}" value="{{ old('date_end') }}" required>
    
                                        @if ($errors->has('date_end'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('date_end') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="user_assign_id">Assign to</label>

                                <select name="user_assign_id" id="select" class="form-control form-control-alternative">
                                    @foreach ($project->contributors as $c)
                                        <option value="{{ $c->user->id }}">{{ $c->user->name }} ({{ $c->user->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success bg-gradient-success">Create child timeline</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach