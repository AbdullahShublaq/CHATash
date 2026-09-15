<?php

namespace Tests\Feature;

use App\Models\PrivateRoom;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UuidRoomBindingTest extends TestCase
{
    use RefreshDatabase;

    public function test_private_room_route_binds_by_uuid(): void
    {
        $owner = User::factory()->create();
        $room = $owner->rooms()->create(['name' => 'UBind', 'slug' => 'ubind-' . uniqid()]);

        $response = $this->actingAs($owner)->get('/private/' . $room->id);

        $response->assertOk();
        $response->assertSee($room->id, false);
    }

    public function test_private_room_route_returns_404_for_missing_uuid(): void
    {
        $owner = User::factory()->create();

        $this->actingAs($owner)->get('/private/00000000-0000-0000-0000-000000000000')
            ->assertNotFound();
    }
}