<?php

namespace Tests\Feature;

use App\Models\Team;

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

it('should delete a team', function () {

    $team = Team::factory()->create();

    $response = $this->deleteJson('/api/teams/' . $team->id);

    $response->assertStatus(204);
    $this->assertCount(5, Team::all());
});
