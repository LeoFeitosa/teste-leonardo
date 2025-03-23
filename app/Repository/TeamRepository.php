<?php

namespace App\Repository;

use App\Contracts\CrudRepositoryInterface;
use App\Models\Team;
use App\Repository\Traits\CrudRepositoryTrait;

class TeamRepository implements CrudRepositoryInterface
{
    use CrudRepositoryTrait;

    public function __construct(Team $team)
    {
        $this->model = $team;
    }

    public function updateOrCreate(array $values): void
    {
        foreach ($values as $team) {
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
