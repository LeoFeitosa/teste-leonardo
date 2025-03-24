<?php

namespace Tests\Unit;

use App\Jobs\FetchGamesJob;
use App\Jobs\FetchPlayersJob;
use App\Jobs\FetchTeamsJob;
use App\Repository\GameRepository;
use App\Repository\PlayerRepository;
use App\Repository\TeamRepository;
use App\Services\BallDontLieService;
use Illuminate\Support\Facades\Queue;
use Mockery;
use Tests\TestCase;

class FetchJobsTest extends TestCase
{
    /**
     * Test if the FetchGamesJob is dispatched.
     */
    public function testFetchGamesJobIsDispatched()
    {
        Queue::fake();

        FetchGamesJob::dispatch();

        Queue::assertPushed(FetchGamesJob::class);
    }

    /**
     * Test if the FetchPlayersJob is dispatched.
     */
    public function testFetchPlayersJobIsDispatched()
    {
        Queue::fake();

        FetchPlayersJob::dispatch();

        Queue::assertPushed(FetchPlayersJob::class);
    }

    /**
     * Test if the FetchTeamsJob is dispatched.
     */
    public function testFetchTeamsJobIsDispatched()
    {
        Queue::fake();

        FetchTeamsJob::dispatch();

        Queue::assertPushed(FetchTeamsJob::class);
    }

    /**
     * Test the execution of FetchGamesJob.
     */
    public function testFetchGamesJobExecutesSuccessfully()
    {
        $mockService = Mockery::mock(BallDontLieService::class);
        $mockRepository = Mockery::mock(GameRepository::class);

        $mockService->shouldReceive('getGames')
            ->once()
            ->andReturn([
                'data' => [
                    ['id' => 1, 'home_team_score' => 100, 'visitor_team_score' => 90],
                    ['id' => 2, 'home_team_score' => 95, 'visitor_team_score' => 97]
                ]
            ]);

        $mockRepository->shouldReceive('updateOrCreate')
            ->once()
            ->with(Mockery::type('array'));

        $job = new FetchGamesJob($mockService, $mockRepository);
        $job->handle($mockService, $mockRepository);

        $mockService->shouldHaveReceived('getGames')->once();
        $mockRepository->shouldHaveReceived('updateOrCreate')->once();
    }

    /**
     * Test the execution of FetchPlayersJob.
     */
    public function testFetchPlayersJobExecutesSuccessfully()
    {
        $mockService = Mockery::mock(BallDontLieService::class);
        $mockRepository = Mockery::mock(PlayerRepository::class);

        $mockService->shouldReceive('getPlayers')
            ->once()
            ->andReturn([
                'data' => [
                    ['id' => 1, 'name' => 'Player 1'],
                    ['id' => 2, 'name' => 'Player 2']
                ]
            ]);

        $mockRepository->shouldReceive('updateOrCreate')
            ->once()
            ->with(Mockery::type('array'));

        $job = new FetchPlayersJob($mockService, $mockRepository);
        $job->handle($mockService, $mockRepository);

        $mockService->shouldHaveReceived('getPlayers')->once();
        $mockRepository->shouldHaveReceived('updateOrCreate')->once();
    }

    /**
     * Test the execution of FetchTeamsJob.
     */
    public function testFetchTeamsJobExecutesSuccessfully()
    {
        $mockService = Mockery::mock(BallDontLieService::class);
        $mockRepository = Mockery::mock(TeamRepository::class);

        $mockService->shouldReceive('getTeams')
            ->once()
            ->andReturn([
                'data' => [
                    ['id' => 1, 'name' => 'Team 1'],
                    ['id' => 2, 'name' => 'Team 2']
                ]
            ]);

        $mockRepository->shouldReceive('updateOrCreate')
            ->once() // Espera uma única chamada
            ->with(Mockery::type('array'));

        $job = new FetchTeamsJob($mockService, $mockRepository);
        $job->handle($mockService, $mockRepository);

        $mockService->shouldHaveReceived('getTeams')->once();
        $mockRepository->shouldHaveReceived('updateOrCreate')->once();
    }
}
