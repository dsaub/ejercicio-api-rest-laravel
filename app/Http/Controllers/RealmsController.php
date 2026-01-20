<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Realm;
use Illuminate\Support\Facades\DB;

class RealmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Realm::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $realm = Realm::create($request->all());
        return response()->json($realm, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $realm = Realm::with(['region', 'heroes', 'artifacts'])->findOrFail($id);
        return response()->json($realm, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $realm = Realm::findOrFail($id);
        $realm->update($request->all());
        return response()->json($realm, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $realm = Realm::find($id);
            if (!$realm) {
                return; // Already deleted; idempotent delete
            }

            // Delete artifacts of the realm (detach pivots first)
            $realmArtifactIds = $realm->artifacts()->pluck('id');
            if ($realmArtifactIds->isNotEmpty()) {
                // Detach all pivot rows for these artifacts
                foreach ($realm->artifacts as $artifact) {
                    $artifact->heroes()->detach();
                }
                $realm->artifacts()->delete();
            }

            // Delete heroes of the realm (detach pivots first)
            foreach ($realm->heroes as $hero) {
                $hero->artifacts()->detach();
                $hero->delete();
            }

            $realm->delete();
        });

        return response()->json(null, 204);
    }

    public function getheroes($id) {
        $realm = Realm::with('heroes')->findOrFail($id);
        return response()->json($realm->heroes, 200);
    }
}
