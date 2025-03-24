<?php

namespace App\Repository;

use App\Contracts\CrudRepositoryInterface;
use App\Models\Player;
use App\Repository\Traits\CrudRepositoryTrait;

class PlayerRepository implements CrudRepositoryInterface
{
    use CrudRepositoryTrait;

    public function __construct(Player $player)
    {
        $this->model = $player;
    }

    public function all()
    {
        return $this->model->with('team')->get();
    }

    public function find($id)
    {
        return $this->model->with('team')->findOrFail($id);
    }

    public function updateOrCreate(array $values): void
    {
        foreach ($values as $player) {
            $this->model->updateOrCreate(
                [
                    'first_name' => $player['first_name'] ?? "",
                    'last_name' => $player['last_name'] ?? null,
                    'position' => $player['position'] ?? null,
                    'height' => $player['height'] ?? null,
                    'weight' => $player['weight'] ?? null,
                    'jersey_number' => $player['jersey_number'] ?? null,
                    'college' => $player['college'] ?? null,
                    'country' => $player['country'] ?? null,
                    'draft_year' => $player['draft_year'] ?? null,
                    'draft_round' => $player['draft_round'] ?? null,
                    'draft_number' => $player['draft_number'] ?? null,
                    'team_id' => $player['team']['id'],
                ]
            );
        }
    }
}
