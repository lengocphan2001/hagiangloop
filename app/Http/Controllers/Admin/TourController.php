<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTourRequest;
use App\Http\Requests\Admin\UpdateTourRequest;
use App\Models\Tour;
use App\Models\TourType;
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
            $validated = $request->validated();
            
            // Handle thumbnail image upload
            if ($request->hasFile('thumbnail_image')) {
                $validated['thumbnail_image'] = $request->file('thumbnail_image')->store('tours/thumbnails', 'public');
            }
            
            // Handle detail images upload
            $detailImages = [];
            if ($request->hasFile('detail_images')) {
                foreach ($request->file('detail_images') as $image) {
                    if ($image && $image->isValid()) {
                        $detailImages[] = $image->store('tours/details', 'public');
                    }
                }
            }
            $validated['detail_images'] = !empty($detailImages) ? $detailImages : null;
            
            $tour = Tour::create($validated);

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

            // Create tour types
            if ($request->has('tour_types') && is_array($request->tour_types)) {
                foreach ($request->tour_types as $typeData) {
                    $tour->tourTypes()->create([
                        'name' => $typeData['name'],
                        'price' => $typeData['price'],
                        'is_active' => isset($typeData['is_active']) ? (bool)$typeData['is_active'] : true,
                        'sort_order' => $typeData['sort_order'] ?? 0,
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
        $tour->load('tourDays.locations', 'tourTypes');
        
        // Prepare tour days data for JavaScript
        $tourDaysData = $tour->tourDays->map(function($day) {
            $locations = $day->locations->map(function($location) {
                $detailImages = [];
                if ($location->detail_images) {
                    if (is_string($location->detail_images)) {
                        $detailImages = json_decode($location->detail_images, true) ?: [];
                    } else {
                        $detailImages = $location->detail_images;
                    }
                }
                return [
                    'name' => $location->name,
                    'description' => $location->description ?? '',
                    'type' => $location->type ?? 'location',
                    'arrival_time' => $location->arrival_time ? $location->arrival_time->format('H:i:s') : null,
                    'thumbnail_image' => $location->thumbnail_image,
                    'detail_images' => $detailImages,
                ];
            })->toArray();
            
            return [
                'day_number' => $day->day_number,
                'title' => $day->title,
                'route' => $day->route ?? '',
                'breakfast_time' => $day->breakfast_time ? $day->breakfast_time->format('H:i:s') : null,
                'departure_time' => $day->departure_time ? $day->departure_time->format('H:i:s') : null,
                'notes' => $day->notes ?? '',
                'locations' => $locations,
            ];
        })->toArray();

        // Prepare tour types data for JavaScript
        $tourTypesData = $tour->tourTypes->map(function($type) {
            return [
                'id' => $type->id,
                'name' => $type->name,
                'price' => $type->price,
                'is_active' => $type->is_active,
                'sort_order' => $type->sort_order,
            ];
        })->toArray();
        
        return view('admin.tours.edit', compact('tour', 'tourDaysData', 'tourTypesData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTourRequest $request, Tour $tour)
    {
        DB::transaction(function () use ($request, $tour) {
            $validated = $request->validated();
            
            // Handle thumbnail image upload
            if ($request->hasFile('thumbnail_image')) {
                // Delete old thumbnail if exists
                if ($tour->thumbnail_image && Storage::disk('public')->exists($tour->thumbnail_image)) {
                    Storage::disk('public')->delete($tour->thumbnail_image);
                }
                $validated['thumbnail_image'] = $request->file('thumbnail_image')->store('tours/thumbnails', 'public');
            } elseif (isset($request->existing_thumbnail_image)) {
                // Keep existing thumbnail
                $validated['thumbnail_image'] = $request->existing_thumbnail_image;
            }
            
            // Handle detail images upload
            $detailImages = [];
            if ($request->hasFile('detail_images')) {
                foreach ($request->file('detail_images') as $image) {
                    if ($image && $image->isValid()) {
                        $detailImages[] = $image->store('tours/details', 'public');
                    }
                }
            }
            
            // Keep existing detail images if provided
            if (isset($request->existing_detail_images) && is_array($request->existing_detail_images)) {
                $existingImages = array_filter($request->existing_detail_images, function($img) {
                    return !empty($img);
                });
                $detailImages = array_merge($detailImages, $existingImages);
            }
            
            $validated['detail_images'] = !empty($detailImages) ? $detailImages : null;
            
            $tour->update($validated);

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

            // Handle tour types
            if ($request->has('tour_types') && is_array($request->tour_types)) {
                // Get existing tour type IDs
                $existingTypeIds = collect($request->tour_types)
                    ->pluck('id')
                    ->filter()
                    ->toArray();

                // Delete tour types that are not in the request
                $tour->tourTypes()->whereNotIn('id', $existingTypeIds)->delete();

                // Update or create tour types
                foreach ($request->tour_types as $typeData) {
                    if (isset($typeData['id']) && $typeData['id']) {
                        // Update existing tour type
                        $tour->tourTypes()->where('id', $typeData['id'])->update([
                            'name' => $typeData['name'],
                            'price' => $typeData['price'],
                            'is_active' => isset($typeData['is_active']) ? (bool)$typeData['is_active'] : true,
                            'sort_order' => $typeData['sort_order'] ?? 0,
                        ]);
                    } else {
                        // Create new tour type
                        $tour->tourTypes()->create([
                            'name' => $typeData['name'],
                            'price' => $typeData['price'],
                            'is_active' => isset($typeData['is_active']) ? (bool)$typeData['is_active'] : true,
                            'sort_order' => $typeData['sort_order'] ?? 0,
                        ]);
                    }
                }
            } else {
                // If no tour types provided, delete all existing ones
                $tour->tourTypes()->delete();
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
