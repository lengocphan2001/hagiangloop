<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BusServiceController extends Controller
{
    /**
     * Get bus services by direction
     */
    public function index(Request $request)
    {
        $direction = $request->get('direction', 'outbound');
        
        $busServices = BusService::where('is_active', true)
            ->where('direction', $direction)
            ->orderBy('sort_order')
            ->orderBy('departure_time')
            ->get()
            ->map(function ($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'type' => $service->type,
                    'departure_time' => $service->departure_time,
                    'pick_up_location' => $service->pick_up_location,
                    'price' => (float) $service->price,
                    'is_recommended' => $service->is_recommended,
                    'starting_point' => $service->starting_point,
                    'return_destination' => $service->return_destination,
                    'direction' => $service->direction,
                    'image' => $service->image ? Storage::url($service->image) : null,
                ];
            });

        return response()->json($busServices);
    }

    /**
     * Get unique starting points for outbound services
     */
    public function getStartingPoints()
    {
        $startingPoints = BusService::where('is_active', true)
            ->where('direction', 'outbound')
            ->whereNotNull('starting_point')
            ->distinct()
            ->pluck('starting_point')
            ->filter()
            ->values();

        return response()->json($startingPoints);
    }

    /**
     * Get unique return destinations for return services
     */
    public function getReturnDestinations()
    {
        $returnDestinations = BusService::where('is_active', true)
            ->where('direction', 'return')
            ->whereNotNull('return_destination')
            ->distinct()
            ->pluck('return_destination')
            ->filter()
            ->values();

        return response()->json($returnDestinations);
    }
}
