<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Game;
use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GamesControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste de criação de jogo
     */
    public function test_store_creates_game()
    {
        // Cria dois times para o jogo
        $team1 = Team::factory()->create();
        $team2 = Team::factory()->create();

        // Dados do jogo
        $gameData = [
            'date' => '1991-12-14',
            'season' => 1994,
            'status' => 'In Progress',
            'period' => 1,
            'home_team_score' => 69,
            'visitor_team_score' => 71,
            'postseason' => 1,
            'time' => '03:24:06',
            'datetime' => '2025-03-02 05:12:12',
        ];

        $response = $this->postJson('/api/games', $gameData);

        $response->assertStatus(201);

        $this->assertDatabaseHas('games', $gameData);
    }

    /**
     * Teste de listagem de jogos
     */
    public function test_index_returns_games()
    {
        Game::factory()->count(3)->create();

        $response = $this->getJson('/api/games');

        $response->assertStatus(200);

        $response->assertJsonCount(3, 'data');
    }

    /**
     * Teste de exibição de um jogo específico
     */
    public function test_show_returns_game()
    {
        $game = Game::factory()->create();

        $response = $this->getJson('/api/games/' . $game->id);

        $response->assertStatus(200);

        $response->assertJson([
            'data' => [
                'id' => $game->id,
                'home_team_score' => $game->home_team_score,
                'visitor_team_score' => $game->visitor_team_score,
            ]
        ]);
    }

    /**
     * Teste de atualização de jogo
     */
    public function test_update_updates_game()
    {
        // Cria um jogo
        $game = Game::factory()->create();

        // Dados atualizados
        $updatedData = [
            'home_team_score' => 100,
            'visitor_team_score' => 90,
        ];

        $response = $this->putJson('/api/games/' . $game->id, $updatedData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('games', [
            'id' => $game->id,
            'home_team_score' => 100,
            'visitor_team_score' => 90,
        ]);
    }

    /**
     * Teste de exclusão de jogo
     */
    public function test_destroy_deletes_game()
    {
        $game = Game::factory()->create();

        $response = $this->deleteJson('/api/games/' . $game->id);

        $response->assertStatus(200);

        $this->assertDatabaseMissing('games', [
            'id' => $game->id,
        ]);
    }
}
