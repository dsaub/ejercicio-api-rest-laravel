<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use Illuminate\Support\Facades\DB;

class RegionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Region::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $region = Region::create($request->all());
        return response()->json($region, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(Region::findOrFail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $region = Region::findOrFail($id);
        $region->update($request->all());
        return response()->json($region, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $region = Region::with(['creatures', 'realms.heroes.artifacts', 'realms.artifacts.heroes'])->findOrFail($id);

            // Delete creatures tied to the region
            foreach ($region->creatures as $creature) {
                $creature->delete();
            }

            // Cascade delete realms and their dependents
            foreach ($region->realms as $realm) {
                // Detach and remove artifacts in the realm
                foreach ($realm->artifacts as $artifact) {
                    $artifact->heroes()->detach();
                    $artifact->delete();
                }

                // Detach hero-artifact pivots and delete heroes in the realm
                foreach ($realm->heroes as $hero) {
                    $hero->artifacts()->detach();
                    $hero->delete();
                }

                $realm->delete();
            }

            $region->delete();
        });

        return response()->json(null, 204);
    }

    public function getcreatures($id) {
        $region = Region::with('creatures')->findOrFail($id);
        return response()->json($region->creatures, 200);
    }
}
