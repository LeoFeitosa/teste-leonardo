<?php

namespace App\Console\Commands;

use App\Jobs\FetchPlayersJob;
use App\Jobs\FetchTeamsJob;
use Illuminate\Console\Command;

class FetchBallDontLieCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:ball-dont-lie';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Busca os dados da API Ball Don\'t Lie e armazena no banco ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        FetchTeamsJob::dispatch();
        FetchPlayersJob::dispatch();
        $this->info('Job de busca de times foi despachado!');
    }
}
