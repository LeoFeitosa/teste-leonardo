<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class FetchBallDontLieApiTest extends TestCase
{
    public function test_external_api_is_available()
    {
        $baseUrl = config('balldontlie.base_url');
        $apiKey = config('balldontlie.api_key');

        $response = Http::withHeaders([
            'Authorization' => $apiKey
        ])->get("{$baseUrl}/teams/1");

        $this->assertEquals(200, $response->status());
    }
}
