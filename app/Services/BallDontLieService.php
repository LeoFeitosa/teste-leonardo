<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class BallDontLieService
{
    private string $baseUrl;
    private string $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('balldontlie.base_url');
        $this->apiKey  = config('balldontlie.api_key');
    }

    private function request(string $endpoint, array $query = [])
    {
        return Http::withHeaders([
            'Authorization' => $this->apiKey
        ])->get("{$this->baseUrl}/{$endpoint}", $query)->json();
    }

    public function getPlayers(array $query = [])
    {
        return $this->request('players', $query);
    }

    public function getTeams()
    {
        return $this->request('teams');
    }

    public function getGames(array $query = [])
    {
        return $this->request('games', $query);
    }
}
