<?php

namespace App\Repository;

use App\Contracts\CrudRepositoryInterface;
use App\Models\Game;
use App\Repository\Traits\CrudRepositoryTrait;
use Illuminate\Support\Facades\Log;

class GameRepository implements CrudRepositoryInterface
{
    use CrudRepositoryTrait;

    private $teamRepository;

    public function __construct(Game $team, TeamRepository $teamRepository)
    {
        $this->model = $team;
        $this->teamRepository = $teamRepository;
    }

    public function all()
    {
        return $this->model->with(['homeTeam', 'visitorTeam'])->get();
    }

    public function find($id)
    {
        return $this->model->with(['homeTeam', 'visitorTeam'])->findOrFail($id);
    }

    public function updateOrCreate(array $values): void
    {
        foreach ($values as $gameData) {
            // Corrigir o uso de updateOrCreate com condições e valores
            $game = Game::updateOrCreate(
                [
                    'id' => $gameData['id'],
                    'date' => $gameData['date'],
                    'season' => $gameData['season'],
                    'status' => $gameData['status'],
                    'period' => $gameData['period'],
                    'home_team_score' => $gameData['home_team_score'],
                    'visitor_team_score' => $gameData['visitor_team_score'],
                    'postseason' => $gameData['postseason'],
                    'time' => $gameData['time'],
                    'datetime' => $gameData['datetime'],
                ]
            );

            // Verificar se os times existem antes de associá-los ao jogo
            $homeTeam = $this->teamRepository->find($gameData['home_team']['id']);
            $visitorTeam = $this->teamRepository->find($gameData['visitor_team']['id']);

            // Se ambos os times existirem, associá-los ao jogo
            if ($homeTeam && $visitorTeam) {
                $game->teams()->sync([
                    $homeTeam->id => ['is_home_team' => true],
                    $visitorTeam->id => ['is_home_team' => false],
                ]);
            } else {
                if (!$homeTeam) {
                    Log::warning("Time da casa não encontrado para o jogo ID: {$gameData['id']}");
                }
                if (!$visitorTeam) {
                    Log::warning("Time visitante não encontrado para o jogo ID: {$gameData['id']}");
                }
            }
        }
    }
}
