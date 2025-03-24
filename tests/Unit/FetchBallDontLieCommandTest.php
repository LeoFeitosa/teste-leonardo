<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use App\Console\Commands\FetchBallDontLieCommand;
use App\Jobs\FetchGamesJob;
use App\Jobs\FetchPlayersJob;
use App\Jobs\FetchTeamsJob;

class FetchBallDontLieCommandTest extends TestCase
{
    public function testFetchBallDontLieCommandExecutesSuccessfully()
    {
        Queue::fake();

        $this->artisan('fetch:ball-dont-lie')
            ->assertExitCode(0);// sucesso (código 0)

        Queue::assertPushed(FetchTeamsJob::class);
        Queue::assertPushed(FetchPlayersJob::class);
        Queue::assertPushed(FetchGamesJob::class);
    }
}
