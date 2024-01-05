<?php

namespace Tests\Feature;

use App\Models\Project;

test('basic projects list', function () {

    $response = $this->getJson('/api/projects');
    $response->assertStatus(200);
    $this->assertCount(5, Project::all());
});


it('should create a project', function () {

    $project = Project::factory()->raw();

    $response = $this->postJson('/api/projects', $project);

    $response->assertStatus(200)
        ->assertJson(['status' => 'project created']);

    $this->assertDatabaseHas('projects', $project);
});

it('should fail if the project name is not present', function () {

    $project = Project::factory()->raw();

    unset($project['name']);

    $response = $this->postJson('/api/projects', $project);

    $response->assertStatus(422);
});

it('should update a project', function () {

    $project = Project::factory()->create();

    $update = ['name' => 'This project name placeholder'];

    $response = $this->putJson('/api/projects/' . $project->id, $update);

    $response->assertStatus(201)
        ->assertJson(['status' => 'project updated']);
    $this->assertDatabaseHas('projects', $update);
});

it('should delete a project', function () {

    $project = Project::factory()->create();

    $response = $this->deleteJson('/api/projects/' . $project->id);

    $response->assertStatus(204);
    $this->assertCount(5, Project::all());
});
