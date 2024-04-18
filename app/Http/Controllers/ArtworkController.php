<?php

namespace App\Http\Controllers;

use App\Models\artwork;
use Illuminate\Http\Request;

class artworkController extends Controller
{
    public function index()
    {
        return artwork::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'state' => ['required'],
            'type' => ['required'],
            'estimated_price' => ['required', 'numeric'],
            'user_id' => ['required', 'exists:users'],
        ]);

        return artwork::create($data);
    }

    public function show(artwork $artwork)
    {
        return $artwork;
    }

    public function update(Request $request, artwork $artwork)
    {
        $data = $request->validate([
            'name' => ['required'],
            'state' => ['required'],
            'type' => ['required'],
            'estimated_price' => ['required', 'numeric'],
            'user_id' => ['required', 'exists:users'],
        ]);

        $artwork->update($data);

        return $artwork;
    }

    public function destroy(artwork $artwork)
    {
        $artwork->delete();

        return response()->json();
    }
}
