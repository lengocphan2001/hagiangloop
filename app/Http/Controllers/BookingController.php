<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display the booking page.
     */
    public function index()
    {
        $tours = Tour::where('is_active', true)
            ->with('tourTypes')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('booking', compact('tours'));
    }
}
