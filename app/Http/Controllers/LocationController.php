<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Database\Factories\LocationFactory;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LocationController extends Controller
{
    public function index(Request $request): \Inertia\Response
    {

        $category = $request->input('category');

        return Inertia::render('Location',[
            'locations' => $category ?  Location::where('category', $category)->get() : Location::all(),
        ]);
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'category' => ['required', 'string', 'in:Rivière,Ruisseau,Fleuve'],
            'latitude' => ['required', 'numeric', 'between:-90,90'],
            'longitude' => ['required', 'numeric', 'between:-180,180'],
            'is_featured' => ['boolean'],
        ]);

        $team = $request->user()->currentTeam;
        $validated['team_id'] = $team->id;
        $validated['is_featured'] = $request->boolean('is_featured', false);

        $location = new Location($validated);
        $location->save();

        return to_route('locations.index');
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return to_route('locationsdashboard.index');
    }
}
