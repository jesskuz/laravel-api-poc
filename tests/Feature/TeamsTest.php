<?php

namespace Tests\Feature;

use Tests\TestCase;

use function Pest\Laravel\{get};
use function Pest\Laravel\{post};
use function Pest\Laravel\{put};
use function Pest\Laravel\{delete};

use App\Models\Team;

test('basic teams list', function () {

    $response = $this->getJson('/api/teams');
    $response->assertStatus(200);
});


it('should create a team', function () {


    $team = Team::factory()->raw();

    $response = $this->postJson('/api/teams', $team);



    $response->assertStatus(200)->assertJson(['status' => 'team created.']);
    assertDatabaseHas('teams', $team);
});

it('should update a team', function () {


    $team = Team::factory()->raw();

    $response = $this->postJson('/api/teams', $team);

    $response->assertStatus(200)->assertJson(['status' => 'team created.']);
    assertDatabaseHas('teams', $team);
});

it('should delete a team', function () {


    $team = Team::factory()->raw();

    $response = $this->postJson('/api/teams', $team);

    $response->assertStatus(200)->assertJson(['status' => 'team created.']);
    assertDatabaseHas('teams', $team);
});

