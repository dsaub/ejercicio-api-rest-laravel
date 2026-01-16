<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class ArtifactHeroController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'artifact_id' => ['required', 'integer', 'exists:artifacts,id'],
            'hero_id' => ['required', 'integer', 'exists:heroes,id'],
        ]);

        // Avoid duplicate pivot rows while attaching the artifact to the hero.
        $hero = Hero::findOrFail($data['hero_id']);
        $hero->artifacts()->syncWithoutDetaching([$data['artifact_id']]);

        return response()->json([
            'message' => 'Artifact attached to hero',
            'artifact_id' => $data['artifact_id'],
            'hero_id' => $data['hero_id'],
        ], 201);
    }

    public function destroy(Request $request)
    {
        $data = $request->validate([
            'artifact_id' => ['required', 'integer', 'exists:artifacts,id'],
            'hero_id' => ['required', 'integer', 'exists:heroes,id'],
        ]);

        $hero = Hero::findOrFail($data['hero_id']);
        $hero->artifacts()->detach([$data['artifact_id']]);

        return response()->json([
            'message' => 'Artifact detached from hero',
            'artifact_id' => $data['artifact_id'],
            'hero_id' => $data['hero_id'],
        ], 200);
    }
}
