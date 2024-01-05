<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of all projects.
     *
     * @return \Illuminate\Http\response $response
     */
    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
        //
    }

    /**
     * Return the project record.
     *
     * @param \App\Models\Project $project
     *
     * @return \Illuminate\Http\response $response
     */
    public function show(Project $project)
    {

        return response()->json($project);
        //
    }


    /**
     * Return members assigned to a project.
     *
     * @param \App\Models\Project $project
     *
     * @return \Illuminate\Http\response $response
     */
    public function getMembers(Project $project)
    {
        $members = $project->members()->get();
        return response()->json($members);
    }

    /**
     * Create a new project record.
     *
     * @param \App\Http\Requests\UpdateProjectRequest $request
     *
     * @return \Illuminate\Http\response $response
     */
    public function store(StoreProjectRequest $request)
    {
        $request->validate([
            'name' => 'required|string',
            'member_id' => 'required|numeric',
        ]);

        $project = new Project();
        $project->name = $request->name;
        $project->member_id = $request->member_id;

        $project->save();

        return response()->json(['status' => 'project created']);
    }

    /**
     * Update the project record.
     *
     * @param \App\Http\Requests\UpdateProjectRequest $request
     * @param \App\Models\Project $project
     *
     * @return \Illuminate\Http\response $response
     */

    public function update(UpdateProjectRequest $request, Project $project)
    {

        $request->validate([
            'name' => 'required|string',
        ]);

        $project->save();

        return response()->json(['status' => 'project updated']);
    }

    /**
     * Add a member to the project.
     *
     * @param \App\Http\Requests\UpdateProjectRequest $request
     * @param \App\Models\Project $project
     *
     * @return \Illuminate\Http\response $response
     */
    public function addMember(UpdateProjectRequest $request, Project $project)
    {

        $request->validate([
            'member_id' => 'required|numeric',
        ]);


        $member_id = $request->member_id;

        $project->members()->syncWithoutDetaching($member_id);

        $project->save();

        return response()->json(['status' => 'member added to project']);
        //
    }

    /**
     * Remove member from project.
     *
     * @param \App\Http\Requests\UpdateProjectRequest $request
     * @param \App\Models\Project $project
     *
     * @return \Illuminate\Http\response $response
     */
    public function removeMember(UpdateProjectRequest $request, Project $project)
    {

        $request->validate([
            'member_id' => 'required|numeric',
        ]);


        $member_id = $request->member_id;

        $project->members()->detach($member_id);

        $project->save();

        return response()->json(['status' => 'member removed from project']);
        //
    }

    /**
     * Delete the project record.
     *
     * @param \App\Models\Project $project
     *
     * @return \Illuminate\Http\response $response
     */
    public function destroy(Project $project)
    {

        $project->delete();

        return response()->json(null, 204);
    }
}
