<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;
use App\Models\Team;
use Exception;

class TeamController extends Controller
{
    /**
     * Return a listing of all teams.
     *
     * @return \Illuminate\Http\response $response
     */
    public function index()
    {

        $teams = Team::all();
        return response()->json($teams);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Team $team
     *
     * @return \Illuminate\Http\response $response
     */
    public function show(Team $team, Exception $e)
    {

        return response()->json($team);
    }


    /**
     * Return the members of a specific team
     *
     * @param \App\Models\Team $team
     *
     * @return \Illuminate\Http\response $response
     */
    public function getMembers(Team $team)
    {
        $team->load('members');

        return response()->json($team);
    }

    /**
     * Create a new team record.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\response $response
     */
    public function store(StoreTeamRequest $request)
    {

        $request->validate([
            'name' => 'required|string',
        ]);

        $team = new Team();
        $team->name = $request->name;

        $team->save();

        return response()->json(['status' => 'team created']);

        //
    }

    /**
     * Update the team record.
     *
     * @param \App\Http\Requests\UpdateTeamRequest $request
     * @param \App\Models\Team $team
     *
     * @return \Illuminate\Http\response $response
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {

        $request->validate([
            'name' => 'required|string',
        ]);

        $team->name = $request->name;

        $team->save();

        return response()->json(['status' => 'team updated'], 201);
        //
    }

    /**
     * Delete the team record.
     *
     * @param \App\Models\Team $team
     *
     * @return \Illuminate\Http\response $response
     */
    public function destroy(Team $team)
    {

        $team->delete();

        return response()->json(null, 204);
        //
    }
}
