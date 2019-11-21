<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectContributor;
use App\User;
use Illuminate\Http\Request;

class ProjectContributorController extends Controller
{
    public function index($id)
    {
        $project = Project::findOrFail($id);
        $contributors = $project->contributors;
        $users = User::all();
        
        return view('contributor.index', compact('project', 'contributors', 'users'));
    }
    
    public function store(Request $request, $project_id)
    {
        ProjectContributor::create([
            'project_id' => $project_id,
            'user_id' => $request->user_id,
            'created_by' => auth()->user()->id,
            'updated_by' => auth()->user()->id,
        ]);

        return redirect()->route('contributor.index', $project_id)->withStatus('Contributor successfully created.');
    }

    public function destroy($project_id, $id)
    {
        $contributor = ProjectContributor::findOrFail($id);

        $contributor->delete();

        return redirect()->route('contributor.index', $project_id)->withStatus('Project successfully created.');
    }
}
