<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectTimeline;
use Illuminate\Http\Request;

class ProjectTimelineController extends Controller
{
    public function index($id)
    {
        $project = Project::findOrFail($id);
        $timelines = $project->timelines;
        
        return view('timeline.index', compact('project', 'timelines'));
    }

    public function create($id)
    {
        $project = Project::findOrFail($id);
        
        return view('timeline.create', compact('project'));
    }

    public function store(Request $request, $id)
    {
        $timeline = ProjectTimeline::create([
            'project_id' => $id,
            'description' => $request->description,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'status' => 0,
            'user_assign_id' => $request->user_assign_id,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        return redirect()->route('timeline.index', $id)->withStatus('Timeline created successfully');
    }

    public function storeChild(Request $request, $id)
    {
        $parentTimeline = ProjectTimeline::findOrFail($request->timeline_id);
        
        $parentTimeline->children()->create([
            'project_id' => $id,
            'description' => $request->description,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'status' => 0,
            'user_assign_id' => $request->user_assign_id,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        return redirect()->route('timeline.index', $id)->withStatus('Timeline created successfully');
    }

    public function edit($id, $timeline_id)
    {
        $project = Project::findOrFail($id);
        $timeline = ProjectTimeline::findOrFail($timeline_id);

        return view('timeline.edit', compact('project', 'timeline'));
    }

    public function update(Request $request, $id, $timeline_id)
    {
        $project = Project::findOrFail($id);
        $timeline = ProjectTimeline::findOrFail($timeline_id);

        $timeline->update([
            'project_id' => $id,
            'description' => $request->description,
            'date_start' => $request->date_start,
            'date_end' => $request->date_end,
            'status' => 0,
            'user_assign_id' => $request->user_assign_id,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        return redirect()->route('timeline.index', $id)->withStatus('Timeline updated successfully');
    }
    
    public function destroy($id, $timeline_id)
    {
        $timeline = ProjectTimeline::findOrFail($timeline_id);

        $timeline->delete();

        return redirect()->route('timeline.index', $id)->withStatus('Timeline deleted successfully');
    }
}
