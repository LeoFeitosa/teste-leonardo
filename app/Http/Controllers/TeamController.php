<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Repository\TeamRepository;

class TeamController extends Controller
{
    private $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->teamRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TeamRequest $request)
    {
        return $this->teamRepository->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->teamRepository->find($id);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(TeamRequest $request, string $id)
    {
        return $this->teamRepository->update($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->teamRepository->delete($id);
    }
}
