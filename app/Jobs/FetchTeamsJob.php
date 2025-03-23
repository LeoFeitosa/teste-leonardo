<?php

namespace App\Jobs;

use App\Repository\TeamRepository;
use App\Services\BallDontLieService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class FetchTeamsJob implements ShouldQueue
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
    public function handle(BallDontLieService $service, TeamRepository $teamRepository): void
    {
        $teams = $service->getTeams();

        if (empty($teams['data'])) {
            Log::warning('Nenhum time foi retornado pela API.');
            return;
        }

        $teamRepository->updateOrCreate($teams['data']);

        Log::info(count($teams) . ' times inseridos/atualizados com sucesso!');
    }

}
