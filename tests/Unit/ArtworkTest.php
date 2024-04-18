<?php

namespace Tests\Unit;

use App\Models\Artwork;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArtworkTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_an_artwork(): void
    {
        $artwork = Artwork::factory()->create([
            'name' => 'Mona Lisa',
            'state' => 'Excellent',
            'type' => 'Painting',
            'estimated_price' => 1000,
        ]);

        $this->assertInstanceOf(Artwork::class, $artwork);
        $this->assertEquals('Mona Lisa', $artwork->name);
        $this->assertEquals('Excellent', $artwork->state);
        $this->assertEquals('Painting', $artwork->type);
        $this->assertEquals(1000, $artwork->estimated_price);
    }

    public function test_belongs_to_a_user(): void
    {
        $user = User::factory()->create();
        $artwork = Artwork::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $artwork->user);
        $this->assertEquals($user->id, $artwork->user->id);
    }

    public function test_can_update_an_artwork(): void
    {
        $artwork = Artwork::factory()->create([
            'name' => 'Starry Night',
            'state' => 'Good',
            'type' => 'Painting',
            'estimated_price' => 500000,
        ]);

        $artwork->update([
            'name' => 'The Scream',
            'state' => 'Fair',
            'type' => 'Drawing',
            'estimated_price' => 700000,
        ]);

        $this->assertEquals('The Scream', $artwork->fresh()->name);
        $this->assertEquals('Fair', $artwork->fresh()->state);
        $this->assertEquals('Drawing', $artwork->fresh()->type);
        $this->assertEquals(700000, $artwork->fresh()->estimated_price);
    }

    public function test_can_delete_an_artwork(): void
    {
        $artwork = Artwork::factory()->create([
            'name' => 'Starry Night',
            'state' => 'Good',
            'type' => 'Painting',
            'estimated_price' => 500000,
        ]);

        $artwork->delete();

        $this->assertDatabaseMissing(Artwork::class, $artwork->toArray());
    }

    public function test_can_show_an_artwork(): void
    {
        $artwork = Artwork::factory()->create([
            'name' => 'Starry Night',
            'state' => 'Good',
            'type' => 'Painting',
            'estimated_price' => 500000,
        ]);

        $this->assertDatabaseHas(Artwork::class, $artwork->toArray());
    }

    public function test_can_list_all_artworks(): void
    {
        $artwork = Artwork::factory()->create([
            'name' => 'Starry Night',
            'state' => 'Good',
            'type' => 'Painting',
            'estimated_price' => 500000,
        ]);

        $this->assertDatabaseHas(Artwork::class, $artwork->toArray());
    }

}
