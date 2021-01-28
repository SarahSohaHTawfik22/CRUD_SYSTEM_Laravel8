<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\project;

class ProjectController extends Controller
{
    //
    public function index()
    {
        $projects = project::latest()->paginate(5);

        return view('projects.index', compact('projects'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'descryption'=>'required',
            'finished_on' => 'required',
            
        ]);

        project::create($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }
    public function show(project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(project $project)
    {
        return view('projects.edit', compact('project'));
    }
    public function update(Request $request, project $project)
    {
        $request->validate([
            'name' => 'required',
            'descryption'=>'required',
            'finished_on' => 'required',
            
        ]);
        $project->update($request->all());

        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully');
    }

    public function destroy(project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully');
    }



}
