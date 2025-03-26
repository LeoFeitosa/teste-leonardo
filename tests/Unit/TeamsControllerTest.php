<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamsControllerTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->actingAs($this->user);
    }

    /**
     * Teste de criação de time
     */
    public function test_store_creates_team()
    {
        // Dados do time
        $teamData = [
            'conference' => 'Eastern Conference',
            'division' => 'Atlantic',
            'city' => 'Boston',
            'name' => 'Celtics',
            'full_name' => 'Boston Celtics',
            'abbreviation' => 'BOS',
        ];

        $response = $this->postJson('/api/teams', $teamData);

        $response->assertStatus(201);

        $this->assertDatabaseHas('teams', $teamData);
    }

    /**
     * Teste de listagem de times
     */
    public function test_index_returns_teams()
    {
        Team::factory()->count(3)->create();

        $response = $this->getJson('/api/teams');

        $response->assertStatus(200);

        $response->assertJsonCount(3, 'data');
    }

    /**
     * Teste de exibição de um time específico
     */
    public function test_show_returns_team()
    {
        $team = Team::factory()->create();

        $response = $this->getJson('/api/teams/' . $team->id);

        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'id' => $team->id,
                'city' => $team->city,
                'name' => $team->name,
                'full_name' => $team->full_name,
                'abbreviation' => $team->abbreviation,
            ]
        ]);
    }

    /**
     * Teste de atualização de time
     */
    public function test_update_updates_team()
    {
        $team = Team::factory()->create();

        $updatedData = [
            'city' => 'New York',
            'name' => 'Knicks',
            'full_name' => 'New York Knicks',
            'abbreviation' => 'NYK',
        ];

        $response = $this->putJson('/api/teams/' . $team->id, $updatedData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('teams', [
            'id' => $team->id,
            'city' => 'New York',
            'name' => 'Knicks',
            'full_name' => 'New York Knicks',
            'abbreviation' => 'NYK',
        ]);
    }

    /**
     * Teste de exclusão de time
     */
    public function test_destroy_deletes_team()
    {
        $team = Team::factory()->create();

        $response = $this->deleteJson('/api/teams/' . $team->id);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('teams', [
            'id' => $team->id,
        ]);
    }
}
