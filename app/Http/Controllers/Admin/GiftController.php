<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGiftRequest;
use App\Http\Requests\Admin\UpdateGiftRequest;
use App\Models\Gift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gifts = Gift::orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.gifts.index', compact('gifts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gifts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGiftRequest $request)
    {
        $validated = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('gifts', 'public');
        }

        Gift::create($validated);

        return redirect()->route('admin.gifts.index')
            ->with('success', 'Gift created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gift $gift)
    {
        return view('admin.gifts.show', compact('gift'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gift $gift)
    {
        return view('admin.gifts.edit', compact('gift'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGiftRequest $request, Gift $gift)
    {
        $validated = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($gift->image && Storage::disk('public')->exists($gift->image)) {
                Storage::disk('public')->delete($gift->image);
            }
            $validated['image'] = $request->file('image')->store('gifts', 'public');
        }

        $gift->update($validated);

        return redirect()->route('admin.gifts.index')
            ->with('success', 'Gift updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gift $gift)
    {
        // Delete image if exists
        if ($gift->image && Storage::disk('public')->exists($gift->image)) {
            Storage::disk('public')->delete($gift->image);
        }

        $gift->delete();

        return redirect()->route('admin.gifts.index')
            ->with('success', 'Gift deleted successfully.');
    }
}
