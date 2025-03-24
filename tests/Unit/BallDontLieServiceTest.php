<?php

namespace Tests\Unit;

use App\Services\BallDontLieService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class BallDontLieServiceTest extends TestCase
{
    public function testGetGamesReturnsData()
    {
        Http::fake([
            'https://api.balldontlie.io/v1/games' => Http::response(['data' => ['mocked_game']], 200),
        ]);

        $service = new BallDontLieService();
        $response = $service->getGames();

        $this->assertEquals(['data' => ['mocked_game']], $response);
    }

    public function testGetPlayersReturnsData()
    {
        Http::fake([
            'https://api.balldontlie.io/v1/players' => Http::response(['data' => ['mocked_player']], 200),
        ]);

        $service = new BallDontLieService();
        $response = $service->getPlayers();

        $this->assertEquals(['data' => ['mocked_player']], $response);
    }

    public function testGetTeamsReturnsData()
    {
        Http::fake([
            'https://api.balldontlie.io/v1/teams' => Http::response(['data' => ['mocked_team']], 200),
        ]);

        $service = new BallDontLieService();
        $response = $service->getTeams();

        $this->assertEquals(['data' => ['mocked_team']], $response);
    }
}
