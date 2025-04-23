<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LocationDashboardController extends Controller
{
    /**
     * Get all location for dashboard location
     * @return \Inertia\Response
     */
    public function index(): \Inertia\Response
    {
        return Inertia::render('LocationDashboard',[
            'locations' => Location::all(),
        ]);
    }
}
