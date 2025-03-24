<?php

namespace Tests\Feature;

use App\Jobs\FetchTeamsJob;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class FetchBallDontLieCommandTest extends TestCase
{
    public function test_external_api_is_available()
    {
        $baseUrl = config('balldontlie.base_url');
        $apiKey = config('balldontlie.api_key');

        $response = Http::withHeaders([
            'Authorization' => $apiKey
        ])->get("{$baseUrl}/teams/1");

        $this->assertEquals(200, $response->status());
    }

    public function test_teams_are_inserted_into_database()
    {
        $teams = [
            [
                "id" => 1,
                "conference" => "East",
                "division" => "Southeast",
                "city" => "Atlanta",
                "name" => "Hawks",
                "full_name" => "Atlanta Hawks",
                "abbreviation" => "ATL",
            ],
            [
                "id" => 2,
                "conference" => "East",
                "division" => "Atlantic",
                "city" => "Boston",
                "name" => "Celtics",
                "full_name" => "Boston Celtics",
                "abbreviation" => "BOS",
            ]
        ];

        Queue::fake();

        FetchTeamsJob::dispatch();

        Queue::assertPushed(FetchTeamsJob::class);

        $this->artisan('queue:work', ['--once' => true]);

        // Verifica se os times foram inseridos no banco de dados
        foreach ($teams as $team) {
            $this->assertDatabaseHas('teams', $team);
        }
    }
}
