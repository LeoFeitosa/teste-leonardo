<?php

namespace App\Repository;

use App\Contracts\CrudRepositoryInterface;
use App\Models\Team;
use Illuminate\Database\Eloquent\Collection;

class TeamRepository implements CrudRepositoryInterface
{
    protected $team;

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    public function create(array $data): Team
    {
        return $this->team->create($data);
    }

    public function update($id, array $data): Team
    {
        $team = $this->team->findOrFail($id);
        $team->update($data);
        return $team;    }

    public function delete($id): bool
    {
        $team = $this->team->findOrFail($id);
        return $team->delete();    }

    public function find($id): Team
    {
        return $this->team->findOrFail($id);
    }

    public function updateOrCreate(array $values): void
    {
        foreach ($values as $team) {
            $this->team->updateOrCreate(
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

    public function all(): Collection
    {
        return $this->team->all();
    }
}
