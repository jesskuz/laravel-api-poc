<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\Member;

test('basic teams list', function () {

    $response = $this->getJson('/api/teams');
    $response->assertStatus(200);
    $this->assertCount(5, Team::all());
});


it('should create a team', function () {

    $team = Team::factory()->raw();

    $response = $this->postJson('/api/teams', $team);

    $response->assertStatus(200)->assertJson(['status' => 'team created']);
    $this->assertDatabaseHas('teams', $team);
});

it('should fail if the team name is not present', function () {
    $member = Team::factory()->raw();

    unset($member['name']);

    $response = $this->postJson('/api/teams', $member);

    $response->assertStatus(422);
});

it('should update a team', function () {

    $team = Team::factory()->create();

    $update = ['name' => 'Golden State'];

    $response = $this->putJson('/api/teams/' . $team->id, $update);

    $response->assertStatus(201)
        ->assertJson(['status' => 'team updated']);
    $this->assertDatabaseHas('teams', $update);
});

it('should return members of a specific team', function () {

    $team = Team::factory()->create();

    $member = Member::factory()->create();
    $update = ['team_id' => $team->id];
    $this->putJson('/api/members/' . $member->id . '/update-team', $update);

    $member = Member::factory()->create();
    $update = ['team_id' => $team->id];
    $this->putJson('/api/members/' . $member->id . '/update-team', $update);

    $member = Member::factory()->create();
    $update = ['team_id' => $team->id];
    $this->putJson('/api/members/' . $member->id . '/update-team', $update);


    $response = $this->getJson('/api/teams/' . $team->id . '/get-members');

    $response->assertStatus(200);
    $response->assertJsonCount(3, $key = null);
});

it('should delete a team', function () {

    $team = Team::factory()->create();

    $response = $this->deleteJson('/api/teams/' . $team->id);

    $response->assertStatus(204);
    $this->assertCount(5, Team::all());
});
