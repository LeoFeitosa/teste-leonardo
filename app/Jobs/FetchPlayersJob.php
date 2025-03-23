<?php

namespace App\Jobs;

use App\Repository\PlayerRepository;
use App\Services\BallDontLieService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class FetchPlayersJob implements ShouldQueue
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
    public function handle(BallDontLieService $service, PlayerRepository $playerRepository): void
    {
        $players = $service->getPlayers();

        if (empty($players['data'])) {
            Log::warning('Nenhum jogador foi retornado pela API.');
            return;
        }

        $playerRepository->updateOrCreate($players['data']);

        Log::info(count($players) . ' jogadores inseridos/atualizados com sucesso!');
    }

}
