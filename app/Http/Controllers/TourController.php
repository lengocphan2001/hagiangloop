<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display a listing of active tours.
     */
    public function index()
    {
        $tours = Tour::where('is_active', true)
            ->with('tourDays.locations')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('tours.index', compact('tours'));
    }

    /**
     * Display the specified tour.
     */
    public function show($slug)
    {
        $tour = Tour::where('slug', $slug)
            ->where('is_active', true)
            ->with(['tourDays.locations', 'tourTypes' => function($query) {
                $query->where('is_active', true)->orderBy('sort_order');
            }])
            ->firstOrFail();

        // Get other tours for recommendations
        $otherTours = Tour::where('is_active', true)
            ->where('id', '!=', $tour->id)
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view('tours.show', compact('tour', 'otherTours'));
    }

    /**
     * Get tour info for a specific tour (API).
     */
    public function getTourInfo($id)
    {
        $tour = Tour::where('id', $id)
            ->where('is_active', true)
            ->firstOrFail();

        return response()->json([
            'id' => $tour->id,
            'name' => $tour->name,
            'slug' => $tour->slug,
            'price' => $tour->price,
            'nights' => $tour->nights,
        ]);
    }
}
