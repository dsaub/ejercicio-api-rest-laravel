<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use App\Models\Artifact;

class HeroesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Eager load hero artifacts; relationship name must be used here.
        return response()->json(Hero::with('artifacts')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hero = Hero::create($request->all());
        return response()->json($hero, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(Hero::with('artifacts')->findOrFail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hero = Hero::findOrFail($id);
        $hero->update($request->all());
        return response()->json($hero, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Hero::destroy($id);
        return response()->json(null, 204);
    }

    /**
     * Display all artifacts of a hero.
     */
    public function artifacts(string $id)
    {
        $hero = Hero::findOrFail($id);
        return response()->json($hero->artifacts, 200);
    }

    public function getalive() {
        $heroes = Hero::with('artifacts')->get();
        $newHeroes = [];
        foreach ($heroes as $value) {
            if ($value->alive == 1) {
                array_push($newHeroes, $value);
            }
        }

        return response()->json($newHeroes);
    }
}
