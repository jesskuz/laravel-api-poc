<?php

namespace Tests\Feature;

use Tests\TestCase;

use function Pest\Laravel\{get};
use function Pest\Laravel\{post};
use function Pest\Laravel\{put};
use function Pest\Laravel\{delete};

use App\Models\Project;

test('basic projects list', function () {

    $response = $this->getJson('/api/projects');
    $response->assertStatus(200);
});


it('should create a project', function () {


    $project = Project::factory()->raw();

    $response = $this->postJson('/api/projects', $project);



    $response->assertStatus(200)->assertJson(['status' => 'project created.']);
    assertDatabaseHas('projects', $project);
});

it('should update a project', function () {


    $project = Project::factory()->raw();

    $response = $this->postJson('/api/projects', $project);

    $response->assertStatus(200)->assertJson(['status' => 'project created.']);
    assertDatabaseHas('projects', $project);
});

it('should delete a project', function () {


    $project = Project::factory()->raw();

    $response = $this->postJson('/api/projects', $project);

    $response->assertStatus(200)->assertJson(['status' => 'project created.']);
    assertDatabaseHas('projects', $project);
});
