<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Models\Member;

class MemberController extends Controller
{
    /**
     * Return a listing of members.
     *
     * @return \Illuminate\Http\response $response
     */
    public function index()
    {
        $members = Member::with('team')->get();
        return response()->json($members);
    }

    /**
     * Return the member record.
     *
     * @param \App\Models\Member $member
     *
     * @return \Illuminate\Http\response $response
     */
    public function show(Member $member)
    {

        $member->load('team');
        return response()->json($member);
    }

    /**
     * Create a new member record.
     *
     * @param \App\Http\Requests\UpdateMemberRequest $request
     *
     * @return \Illuminate\Http\response $response
     */
    public function store(StoreMemberRequest $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'team_id' => 'required|numeric',
        ]);


        $member = new Member();

        isset($request->first_name) && $member->first_name = $request->first_name;
        isset($request->last_name) && $member->last_name = $request->last_name;
        isset($request->city) && $member->city = $request->city;
        isset($request->state) && $member->state = $request->state;
        isset($request->country) && $member->country = $request->country;
        isset($request->team_id) && $member->team_id = $request->team_id;

        $member->save();

        return response()->json(['status' => 'member created']);
        //
    }

    /**
     * Update the member record.
     *
     * @param \App\Http\Requests\UpdateMemberRequest $request
     * @param \App\Models\Member $member
     *
     * @return \Illuminate\Http\response $response
     */
    public function update(UpdateMemberRequest $request, Member $member)
    {

        isset($request->first_name) && $member->first_name = $request->first_name;
        isset($request->last_name) && $member->last_name = $request->last_name;
        isset($request->city) && $member->city = $request->city;
        isset($request->state) && $member->state = $request->state;
        isset($request->country) && $member->country = $request->country;
        isset($request->team_id) && $member->team_id = $request->team_id;

        // $values = array_filter($request->all());

        $member->save();

        return response()->json(['status' => 'member updated'],201);
        //
    }

    /**
     * Update a member's associated team.
     *
     * @param \App\Http\Requests\UpdateMemberRequest $request
     * @param \App\Models\Member $member
     *
     * @return \Illuminate\Http\response $response
     */
    public function updateTeam(UpdateMemberRequest $request, Member $member)
    {
        $request->validate([
            'team_id' => 'required|numeric',
        ]);

        $member->team_id = $request->team_id;

        $member->save();

        return response()->json(['status' => 'member updated'], 201);
        //
    }

    /**
     * Delete the member record.
     *
     * @param \App\Models\Member $member
     *
     * @return \Illuminate\Http\response $response
     */
    public function destroy(Member $member)
    {

        $member->delete();

        return response()->json(null, 204);
        //
    }
}
