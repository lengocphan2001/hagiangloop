<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Tour;
use App\Models\News;
use App\Models\Gift;
use App\Models\BusService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function index()
    {
        // Orders statistics
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $confirmedOrders = Order::where('status', 'confirmed')->count();
        $completedOrders = Order::where('status', 'completed')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        
        // Orders this month
        $ordersThisMonth = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        // Total revenue
        $totalRevenue = Order::where('status', '!=', 'cancelled')
            ->sum('total_price');
        
        // Revenue this month
        $revenueThisMonth = Order::where('status', '!=', 'cancelled')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('total_price');
        
        // Other statistics
        $totalTours = Tour::count();
        $activeTours = Tour::where('is_active', true)->count();
        $totalNews = News::count();
        $totalGifts = Gift::count();
        $totalBusServices = BusService::where('is_active', true)->count();
        
        // Recent orders
        $recentOrders = Order::with(['tour', 'outboundBusService', 'returnBusService'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalOrders',
            'pendingOrders',
            'confirmedOrders',
            'completedOrders',
            'cancelledOrders',
            'ordersThisMonth',
            'totalRevenue',
            'revenueThisMonth',
            'totalTours',
            'activeTours',
            'totalNews',
            'totalGifts',
            'totalBusServices',
            'recentOrders'
        ));
    }
}

