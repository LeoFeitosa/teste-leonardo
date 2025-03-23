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

    public function updateOrCreate(array $values): void
    {
        foreach ($values as $player) {
            $this->model->updateOrCreate(
                [
                    'abbreviation' => $team['abbreviation'] ?? "",
                    'conference' => $team['conference'] ?? null,
                    'division' => $team['division'] ?? null,
                    'city' => $team['city'] ?? "",
                    'name' => $team['name'] ?? "",
                    'full_name' => $team['full_name'] ?? "",
                ]
            );
        }
    }
}
