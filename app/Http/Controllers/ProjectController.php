<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectContributor;
use App\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return redirect()->route('home');
    }

    public function create()
    {
        return view('project.create');
    }

    public function store(Request $request)
    {
        $project = Project::create($request->all());

        ProjectContributor::create([
            'project_id' => $project->id,
            'user_id' => auth()->user()->id,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        return redirect()->route('project.show', $project->id)->withStatus('Project successfully created.');
    }

    public function show($id)
    {
        $project = Project::findOrFail($id);
        $users = User::where('id', '!=', $project->contributors->pluck('user_id')->toArray())->get();
        
        return view('project.show', compact('project', 'users'));
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        
        return view('project.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $project->update($request->all());

        return redirect()->route('project.show', $project->id)->withStatus('Project successfully created.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $project->delete();
        
        return redirect()->route('project.show', $project->id)->withStatus('Project successfully created.');
    }
}
