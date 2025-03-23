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
        $teams = $service->getPlayers();

        if (empty($teams['data'])) {
            Log::warning('Nenhum time foi retornado pela API.');
            return;
        }

        $playerRepository->updateOrCreate($teams['data']);

        Log::info(count($teams) . ' jogadores inseridos/atualizados com sucesso!');
    }

}
