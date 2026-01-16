<?php

namespace App\Http\Controllers;

use App\Models\Creature;
use Illuminate\Http\Request;

class CreatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Creature::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $creature = Creature::create($request->all());
        return response()->json($creature, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Creature::findOrFail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $creature = Creature::findOrFail($id);
        $creature->update($request->all());
        return response()->json($creature, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Creature::destroy($id);
        return response()->json(null, 204);
    }
    
    public function getdangerous(Request $request) {
        $dangerMeter = $request->query('level');
        $creatures = Creature::all();
        $newCreatureList = [];

        foreach ($creatures as $creature) {
            if ($creature->threat_level >= $dangerMeter) {
                array_push($newCreatureList, $creature);
            }
        }
        return response()->json($newCreatureList, 200);
    }
}
