<?php

namespace App\Http\Controllers;

use App\Http\Resources\GameResource;
use App\Repository\GameRepository;
use Illuminate\Http\Request;

class GamesController extends Controller
{

    private $gameRepository;

    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return GameResource::collection($this->gameRepository->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->gameRepository->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new GameResource($this->gameRepository->find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return $this->gameRepository->update($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->gameRepository->delete($id);
    }
}
