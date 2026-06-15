<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\VirtualTour;

class VirtualTourController extends Controller
{
    /**
     * Display the virtual tour viewer.
     */
    public function index()
    {
        $tour = VirtualTour::where('is_active', true)->first();
        return view('public.virtual_tour', compact('tour'));
    }
}
