<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerRequest;
use App\Http\Resources\PlayerResource;
use App\Repository\PlayerRepository;

class PlayersController extends Controller
{
    private $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new PlayerResource($this->playerRepository->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlayerRequest $request)
    {
        return $this->playerRepository->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new PlayerResource($this->playerRepository->find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlayerRequest $request, string $id)
    {
        return $this->playerRepository->update($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->playerRepository->delete($id);
    }
}
