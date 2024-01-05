<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\Team;

test('basic members list', function () {

    $response = $this->getJson('/api/members');
    $response->assertStatus(200);
    $this->assertCount(30, Member::all());
});


it('should create a member', function () {

    $member = Member::factory()->raw();

    $response = $this->postJson('/api/members', $member);

    $response->assertStatus(200)
        ->assertJson(['status' => 'member created']);

    $this->assertDatabaseHas('members', $member);
});

it('should fail if the first and last name are not present', function () {

    $member = Member::factory()->raw();

    unset($member['first_name']);
    unset($member['last_name']);

    $response = $this->postJson('/api/members', $member);

    $response->assertStatus(422);
});

it('should update a member', function () {

    $member = Member::factory()->create();

    $update = ['first_name' => 'Jesse'];

    $response = $this->putJson('/api/members/' . $member->id, $update);

    $response->assertStatus(201)
        ->assertJson(['status' => 'member updated']);
    $this->assertDatabaseHas('members', $update);
});



it('should update the team of a member', function () {


    $team = Team::factory()->create();

    $member = Member::factory()->create();

    $update = ['team_id' => $team->id];

    $response = $this->putJson('/api/members/' . $member->id . '/update-team', $update);

    $response->assertStatus(201)
        ->assertJson(['status' => 'member team updated']);
    $this->assertDatabaseHas('members', $update);
});

it('should delete a member', function () {

    $member = Member::factory()->create();


    $response = $this->deleteJson('/api/members/' . $member->id);

    $response->assertStatus(204);
    $this->assertCount(30, Member::all());
});
