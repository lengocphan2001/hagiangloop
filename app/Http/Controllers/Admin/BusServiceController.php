<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBusServiceRequest;
use App\Http\Requests\Admin\UpdateBusServiceRequest;
use App\Models\BusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $busServices = BusService::orderBy('direction')
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.bus-services.index', compact('busServices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.bus-services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBusServiceRequest $request)
    {
        $validated = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('bus-services', 'public');
        }

        // Handle boolean fields
        $validated['is_recommended'] = $request->has('is_recommended');
        $validated['is_active'] = $request->has('is_active');

        BusService::create($validated);

        return redirect()->route('admin.bus-services.index')
            ->with('success', 'Bus service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BusService $busService)
    {
        return view('admin.bus-services.show', compact('busService'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BusService $busService)
    {
        return view('admin.bus-services.edit', compact('busService'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBusServiceRequest $request, BusService $busService)
    {
        $validated = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($busService->image && Storage::disk('public')->exists($busService->image)) {
                Storage::disk('public')->delete($busService->image);
            }
            $validated['image'] = $request->file('image')->store('bus-services', 'public');
        }

        // Handle boolean fields
        $validated['is_recommended'] = $request->has('is_recommended');
        $validated['is_active'] = $request->has('is_active');

        $busService->update($validated);

        return redirect()->route('admin.bus-services.index')
            ->with('success', 'Bus service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BusService $busService)
    {
        // Delete image if exists
        if ($busService->image && Storage::disk('public')->exists($busService->image)) {
            Storage::disk('public')->delete($busService->image);
        }

        $busService->delete();

        return redirect()->route('admin.bus-services.index')
            ->with('success', 'Bus service deleted successfully.');
    }
}
