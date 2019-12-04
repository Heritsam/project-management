<?php

namespace App\Http\Controllers;

use App\ProjectTimeline as Timeline;
use App\ProjectTimelineComment as Comment;
use Illuminate\Http\Request;

class ProjectTimelineCommentController extends Controller
{
    public function store(Request $request, $id, $timeline_id)
    {
        $timeline = Timeline::findOrFail($timeline_id);
        
        Comment::create([
            'project_timelines_id' => $timeline_id,
            'message' => $request->message,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        return redirect()->route('timeline.index', $id)->withStatus('Comment posted on \'' . $timeline->description . '\' timeline');
    }

    public function destroy($id, $timeline_id, $comment_id)
    {
        
    }
}
