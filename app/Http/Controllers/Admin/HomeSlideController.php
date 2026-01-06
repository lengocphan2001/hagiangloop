<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreHomeSlideRequest;
use App\Http\Requests\Admin\UpdateHomeSlideRequest;
use App\Models\HomeSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSlideController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slides = HomeSlide::orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.home-slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.home-slides.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHomeSlideRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('home-slides', 'public');
        }

        HomeSlide::create($validated);

        return redirect()->route('admin.home-slides.index')
            ->with('success', 'Home slide created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeSlide $homeSlide)
    {
        return view('admin.home-slides.show', compact('homeSlide'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeSlide $homeSlide)
    {
        return view('admin.home-slides.edit', compact('homeSlide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHomeSlideRequest $request, HomeSlide $homeSlide)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($homeSlide->image && Storage::disk('public')->exists($homeSlide->image)) {
                Storage::disk('public')->delete($homeSlide->image);
            }
            $validated['image'] = $request->file('image')->store('home-slides', 'public');
        }

        $homeSlide->update($validated);

        return redirect()->route('admin.home-slides.index')
            ->with('success', 'Home slide updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeSlide $homeSlide)
    {
        // Delete image
        if ($homeSlide->image && Storage::disk('public')->exists($homeSlide->image)) {
            Storage::disk('public')->delete($homeSlide->image);
        }

        $homeSlide->delete();

        return redirect()->route('admin.home-slides.index')
            ->with('success', 'Home slide deleted successfully.');
    }
}
