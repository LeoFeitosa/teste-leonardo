<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use App\Models\Player;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlayersControllerTest extends TestCase
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
     * Teste de criação de jogador
     */
    public function test_store_creates_player()
    {
        $team = Team::factory()->create();

        $playerData = [
            'first_name' => 'LeBron',
            'last_name' => 'James',
            'position' => 'SF',
            'height' => '6\'9"',
            'weight' => 250,
            'jersey_number' => '23',
            'college' => 'St. Vincent-St. Mary',
            'country' => 'USA',
            'draft_year' => 2003,
            'draft_round' => 1,
            'draft_number' => 1,
            'team_id' => $team->id,
        ];

        $response = $this->postJson('/api/players', $playerData);

        $response->assertStatus(201);

        $this->assertDatabaseHas('players', $playerData);
    }

    /**
     * Teste de listagem de jogadores
     */
    public function test_index_returns_players()
    {
        Team::factory()->create();

        Player::factory()->count(3)->create();

        $response = $this->getJson('/api/players');

        $response->assertStatus(200);

        $response->assertJsonCount(3, 'data');
    }

    /**
     * Teste de exibição de jogador específico
     */
    public function test_show_returns_player()
    {
        $team = Team::factory()->create();

        $player = Player::factory()->create(['team_id' => $team->id]);

        $response = $this->getJson('/api/players/' . $player->id);

        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'id' => $player->id,
                'first_name' => $player->first_name,
                'last_name' => $player->last_name,
            ]
        ]);
    }

    /**
     * Teste de atualização de jogador
     */
    public function test_update_updates_player()
    {
        $team = Team::factory()->create();

        $player = Player::factory()->create(['team_id' => $team->id]);

        $updatedData = [
            'first_name' => 'Kobe',
            'last_name' => 'Bryant',
            'position' => 'SG',
            'height' => '6\'6"',
            'weight' => 212,
            'jersey_number' => '24',
            'college' => 'Lower Merion',
            'country' => 'USA',
            'draft_year' => 1996,
            'draft_round' => 1,
            'draft_number' => 13,
            'team_id' => $team->id,
        ];

        $response = $this->putJson('/api/players/' . $player->id, $updatedData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('players', $updatedData);
    }

    /**
     * Teste de exclusão de jogador
     */
    public function test_destroy_deletes_player()
    {
        $team = Team::factory()->create();

        $player = Player::factory()->create(['team_id' => $team->id]);

        $response = $this->deleteJson('/api/players/' . $player->id);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('players', [
            'id' => $player->id,
        ]);
    }
}
