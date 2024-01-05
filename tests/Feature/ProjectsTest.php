<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\Member;

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

it('should add a member to a project', function () {

    $project = Project::factory()->create();

    $member = Member::factory()->create();
    $add = ['member_id' => $member->id];
    $this->putJson('/api/projects/' . $project->id . '/add-member', $add)
        ->assertStatus(201)
        ->assertJson(['status' => 'member added to project']);

    $this->getJson('/api/projects/' . $project->id . '/get-members')
        ->assertStatus(200)
        ->assertJsonCount(1, null);
});

it('should return members on a specific project', function () {

    // somewhat duplicates the above test to achieve necessary state
    // could be refactored or seeded differently.
    $project = Project::factory()->create();

    $member = Member::factory()->create();
    $add = ['member_id' => $member->id];
    $this->putJson('/api/projects/' . $project->id . '/add-member', $add);

    $member = Member::factory()->create();
    $add = ['member_id' => $member->id];
    $this->putJson('/api/projects/' . $project->id . '/add-member', $add);

    $member = Member::factory()->create();
    $add = ['member_id' => $member->id];
    $this->putJson('/api/projects/' . $project->id . '/add-member', $add);


    $this->getJson('/api/projects/' . $project->id . '/get-members')
        ->assertStatus(200)
        ->assertJsonCount(3, null);
});

it('should remove a member from a project', function () {

    $project = Project::factory()->create();

    $member = Member::factory()->create();
    $update = ['member_id' => $member->id];

    $this->putJson('/api/projects/' . $project->id . '/add-member', $update);
    $this->getJson('/api/projects/' . $project->id . '/get-members');

    $this->putJson('/api/projects/' . $project->id . '/remove-member', $update)
        ->assertStatus(201)
        ->assertJson(['status' => 'member removed from project']);

    $this->getJson('/api/projects/' . $project->id . '/get-members')
        ->assertStatus(200)
        ->assertJsonCount(0, null);
});

it('should delete a project', function () {

    $project = Project::factory()->create();

    $response = $this->deleteJson('/api/projects/' . $project->id);

    $response->assertStatus(204);
    $this->assertCount(5, Project::all());
});
