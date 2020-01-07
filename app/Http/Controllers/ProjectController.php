<?php

namespace App\Http\Controllers;

use App\Charts\Chart;

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

    /**
     * Project overview
     */
    public function show($id)
    {        
        $project = Project::findOrFail($id);
        $users = User::where('id', '!=', $project->contributors->pluck('user_id')->toArray())->get();

        $chart = $this->createChart($project);
        $pieChart = $this->createPieChart($project);
        
        return view('project.show', compact('project', 'users', 'chart', 'pieChart'));
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

        return redirect()->route('project.show', $project->id)->withStatus('Project information successfully updated.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        $project->delete();
        
        return redirect()->route('home')->withStatus('Project successfully removed.');
    }

    public function settings($id)
    {
        $project = Project::findOrFail($id);
        
        return view('project.settings', compact('project'));
    }

    /**
     * Initialize a chart
     * 
     * @return ConsoleTVs\Charts\Classes\Chartjs\Chart
     */
    private function createChart($data) 
    {
        $chart = new Chart;
        $labels = collect([]);
        $datasets = collect([]);

        $start_date = $data->date_start;
        $end_date = $data->date_due;

        for ($date = $start_date; $date->lte($end_date); $date->addDay()) {
            $labels->push($date->format('d M Y'));

            $datasets->push($data->timelines->where('date_done', $date->format('Y-m-d'))->count());
        }
        
        $chart->labels($labels);
        $chart->displayLegend(true);
        $chart->dataset('Timelines', 'line', $datasets)->backgroundColor('#536dfe00')->color('#536dfe');

        return $chart;
    }
    
    /**
     * Initialize a pie chart
     * 
     * @return ConsoleTVs\Charts\Classes\Chartjs\Chart
     */
    private function createPieChart($data)
    {
        $chart = new Chart;
        $labels = collect(['Done', 'Pending']);
        $datasets = collect([]);

        $datasets->push($data->timelines->where('date_done', '!=', null)->count());
        $datasets->push($data->timelines->where('date_done', '==', null)->count());

        $chart->labels($labels);
        $chart->displayLegend(true);
        $chart->dataset('Timelines', 'pie', $datasets)->backgroundColor(['#536dfe', '#ff5252']);
        
        return $chart;
    }
}
