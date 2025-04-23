<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LocationDashboardController extends Controller
{
    public function index(): \Inertia\Response
    {
        return Inertia::render('LocationDashboard',[
            'locations' => Location::all(),
        ]);
    }
}
