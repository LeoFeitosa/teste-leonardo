<?php

namespace App\Jobs;

use App\Repository\GameRepository;
use App\Repository\PlayerRepository;
use App\Services\BallDontLieService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class FetchGamesJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(BallDontLieService $service, GameRepository $gameRepository): void
    {
        $games = $service->getGames();

        if (empty($games['data'])) {
            Log::warning('Nenhum jogo foi retornado pela API.');
            return;
        }

        $gameRepository->updateOrCreate($games['data']);

        Log::info(count($games) . ' jogos inseridos/atualizados com sucesso!');
    }

}
