<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Image;
use Session;
class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', ['projects'=>$projects]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          
        $validatedData = $request->validate([
            'name' => 'bail|required|max:190',
            'technology_text'=> 'required',
            'design_text' => 'required',
            'final_text' => 'required',
            'design_image'=> 'sometimes|required|image|max:6000',
            'final_image'=> 'sometimes|required|image|max:6000'
        ]);

        //store in database
            $project = new Project;
            $project->name = $request->name;
            $project->technology_text = $request->technology_text;
            $project->design_text = $request->design_text;
            $project->final_text = $request->final_text;
            if($request->hasFile('design_image')){
                $design_image = $request->design_image->store('/projects');
                $thumbnail = str_replace(".jpeg", "-width-400.jpeg",$design_image);
                $thumbnail = "images/" . $thumbnail;
                Image::make($request->design_image)->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumbnail)->destroy();
                $project->design_image = $design_image;
            }
            if($request->hasFile('final_image')){
                $final_image = $request->final_image->store('/projects');
                $thumbnail = str_replace(".jpeg", "-width-400.jpeg",$final_image);
                $thumbnail = "images/" . $thumbnail;
                Image::make($request->final_image)->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($thumbnail)->destroy();

                $project->final_image = $final_image;
            }
            $project->save();

        Session::flash('success', 'Project successfully saved');
        return redirect()->route('projects.show', $project);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}