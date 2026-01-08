<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Realms;

class RealmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Realms::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $realm = Realms::create($request->all());
        return response()->json($realm, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return response()->json(Realms::findOrFail($id), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $realm = Realms::findOrFail($id);
        $realm->update($request->all());
        return response()->json($realm, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Realms::destroy($id);
        return response()->json(null, 204);
    }
}
