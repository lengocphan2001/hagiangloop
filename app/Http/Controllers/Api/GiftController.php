<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GiftController extends Controller
{
    /**
     * Get all active gifts
     */
    public function index()
    {
        $gifts = Gift::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($gift) {
                return [
                    'id' => $gift->id,
                    'name' => $gift->name,
                    'image' => $gift->image ? Storage::url($gift->image) : null,
                ];
            });

        return response()->json($gifts);
    }
}
