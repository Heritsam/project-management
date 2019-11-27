<?php

namespace App\Http\Controllers;

use App\Project;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $projects = Project::all();
        $my_projects = auth()->user()->contributes;

        return view('home', compact('projects', 'my_projects'));
    }
}
