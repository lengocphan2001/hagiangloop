<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTourRequest;
use App\Http\Requests\Admin\UpdateTourRequest;
use App\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Tour::with('tourDays.locations')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tours.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTourRequest $request)
    {
        DB::transaction(function () use ($request) {
            $tour = Tour::create($request->validated());

            // Create tour days and locations
            foreach ($request->days_data as $dayData) {
                $day = $tour->tourDays()->create([
                    'day_number' => $dayData['day_number'],
                    'title' => $dayData['title'],
                    'route' => $dayData['route'] ?? null,
                    'breakfast_time' => $dayData['breakfast_time'] ?? null,
                    'departure_time' => $dayData['departure_time'] ?? null,
                    'notes' => $dayData['notes'] ?? null,
                    'sort_order' => $dayData['day_number'],
                ]);

                // Create locations for this day
                foreach ($dayData['locations'] as $index => $locationData) {
                    // Handle thumbnail image upload
                    $thumbnailImage = null;
                    if (isset($locationData['thumbnail_image']) && $locationData['thumbnail_image']->isValid()) {
                        $thumbnailImage = $locationData['thumbnail_image']->store('tours/locations/thumbnails', 'public');
                    }

                    // Handle detail images upload
                    $detailImages = [];
                    if (isset($locationData['detail_images']) && is_array($locationData['detail_images'])) {
                        foreach ($locationData['detail_images'] as $detailImage) {
                            if ($detailImage && $detailImage->isValid()) {
                                $detailImages[] = $detailImage->store('tours/locations/details', 'public');
                            }
                        }
                    }

                    $day->locations()->create([
                        'name' => $locationData['name'],
                        'description' => $locationData['description'] ?? null,
                        'type' => $locationData['type'] ?? 'location',
                        'arrival_time' => $locationData['arrival_time'] ?? null,
                        'thumbnail_image' => $thumbnailImage,
                        'detail_images' => !empty($detailImages) ? $detailImages : null,
                        'sort_order' => $index + 1,
                    ]);
                }
            }
        });

        return redirect()->route('admin.tours.index')
            ->with('success', 'Tour created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tour $tour)
    {
        $tour->load('tourDays.locations');
        return view('admin.tours.show', compact('tour'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        $tour->load('tourDays.locations');
        return view('admin.tours.edit', compact('tour'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourRequest $request, Tour $tour)
    {
        DB::transaction(function () use ($request, $tour) {
            $tour->update($request->validated());

            // Delete existing days and locations
            $tour->tourDays()->delete();

            // Create updated tour days and locations
            foreach ($request->days_data as $dayData) {
                $day = $tour->tourDays()->create([
                    'day_number' => $dayData['day_number'],
                    'title' => $dayData['title'],
                    'route' => $dayData['route'] ?? null,
                    'breakfast_time' => $dayData['breakfast_time'] ?? null,
                    'departure_time' => $dayData['departure_time'] ?? null,
                    'notes' => $dayData['notes'] ?? null,
                    'sort_order' => $dayData['day_number'],
                ]);

                // Create locations for this day
                foreach ($dayData['locations'] as $index => $locationData) {
                    // Handle thumbnail image upload
                    $thumbnailImage = null;
                    if (isset($locationData['thumbnail_image']) && $locationData['thumbnail_image']->isValid()) {
                        $thumbnailImage = $locationData['thumbnail_image']->store('tours/locations/thumbnails', 'public');
                    } elseif (isset($locationData['existing_thumbnail_image'])) {
                        // Keep existing thumbnail if no new one uploaded
                        $thumbnailImage = $locationData['existing_thumbnail_image'];
                    }

                    // Handle detail images upload
                    $detailImages = [];
                    if (isset($locationData['detail_images']) && is_array($locationData['detail_images'])) {
                        foreach ($locationData['detail_images'] as $detailImage) {
                            if ($detailImage && $detailImage->isValid()) {
                                $detailImages[] = $detailImage->store('tours/locations/details', 'public');
                            }
                        }
                    }
                    
                    // Keep existing detail images if provided (filter out empty values when user removes images)
                    if (isset($locationData['existing_detail_images']) && is_array($locationData['existing_detail_images'])) {
                        $existingImages = array_filter($locationData['existing_detail_images'], function($img) {
                            return !empty($img);
                        });
                        $detailImages = array_merge($detailImages, $existingImages);
                    }

                    $day->locations()->create([
                        'name' => $locationData['name'],
                        'description' => $locationData['description'] ?? null,
                        'type' => $locationData['type'] ?? 'location',
                        'arrival_time' => $locationData['arrival_time'] ?? null,
                        'thumbnail_image' => $thumbnailImage,
                        'detail_images' => !empty($detailImages) ? $detailImages : null,
                        'sort_order' => $index + 1,
                    ]);
                }
            }
        });

        return redirect()->route('admin.tours.index')
            ->with('success', 'Tour updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        $tour->delete();

        return redirect()->route('admin.tours.index')
            ->with('success', 'Tour deleted successfully.');
    }
}
