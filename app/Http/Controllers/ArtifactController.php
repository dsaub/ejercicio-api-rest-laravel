<?php

namespace App\Http\Controllers;

use App\Models\Artifact;
use Illuminate\Http\Request;

class ArtifactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Artifact::with('heroes')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $artifact = Artifact::create($request->all());
        return response()->json($artifact, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Artifact::with('heroes')->findOrFail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $artifact = Artifact::findOrFail($id);
        $artifact->update($request->all());
        return response()->json($artifact, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Artifact::destroy($id);
        return response()->json(null, 204);
    }

    /**
     * Display all heroes that possess an artifact.
     */
    public function heroes(string $id)
    {
        $artifact = Artifact::findOrFail($id);
        return response()->json($artifact->heroes, 200);
    }

    public function gettop() {
        $artifacts = Artifact::with('heroes')->get();
        $newArray = [];
        foreach ($artifacts as $artifact) {
            if ($artifact->power_level > 90) {
                array_push($newArray, $artifact);
            }
        }

        return response()->json($newArray, 200);
    }
}
