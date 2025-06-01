<?php

namespace Tests\Feature\UserManagement;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PetOwnerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    protected $adminUser,$clientUser,$vetUser,$staffUser;

    public function setUp(): void
    {
        parent::setUp();


        $roles = ['admin', 'client', 'veterinary', 'staff'];
        $userRoles = array_map(function($role) {
            return User::factory()->create(['role' => $role]);
        }, $roles);

        $this->adminUser = $userRoles[0];
        $this->clientUser = $userRoles[1];
        $this->vetUser = $userRoles[2];
        $this->staffUser = $userRoles[3];

    }
    public function test_owner_page_is_displayed_only_to_admin(): void
    {
        $responses = [
            [$this->adminUser, 200],
            [$this->clientUser, 200],
            [$this->vetUser, 200],
            [$this->staffUser, 200],
        ];

        foreach ($responses as $user) {
            $response = $this->actingAs($user[0])->get(route('owners.index'));
            $response->assertStatus($user[1]);
        }
    }


}
