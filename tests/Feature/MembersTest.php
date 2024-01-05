<?php

namespace Tests\Feature;

use Tests\TestCase;

use function Pest\Laravel\{get};
use function Pest\Laravel\{post};
use function Pest\Laravel\{put};
use function Pest\Laravel\{delete};
use function PHPUnit\Framework\assertTrue;

use App\Models\Member;

test('basic members list', function () {

    $response = $this->getJson('/api/members');
    $response->assertStatus(200);
});


it('should create a member', function () {


    $member = Member::factory()->raw();

    $response = $this->postJson('/api/members', $member);



    $response->assertStatus(200)->assertJson(['status' => 'member created.']);
    assertDatabaseHas('members', $member);
});

it('should update a member', function () {


    $member = Member::factory()->raw();

    $response = $this->postJson('/api/members', $member);

    $response->assertStatus(200)->assertJson(['status' => 'member created.']);
    assertDatabaseHas('members', $member);
});

it('should delete a member', function () {


    $member = Member::factory()->raw();

    $response = $this->postJson('/api/members', $member);

    $response->assertStatus(200)->assertJson(['status' => 'member created.']);
    assertDatabaseHas('members', $member);
});

