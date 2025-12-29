@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <!-- Statistics Row -->
    <div class="row">
        <!-- Total Orders -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $totalOrders }}</h3>
                    <p>Total Orders</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <!-- Orders This Month -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $ordersThisMonth }}</h3>
                    <p>Orders This Month</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <!-- Total Revenue -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ number_format($totalRevenue, 0, ',', '.') }}<sup style="font-size: 20px">₫</sup></h3>
                    <p>Total Revenue</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        
        <!-- Revenue This Month -->
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ number_format($revenueThisMonth, 0, ',', '.') }}<sup style="font-size: 20px">₫</sup></h3>
                    <p>Revenue This Month</p>
                </div>
                <div class="icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>

    <!-- Order Status Row -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-clock"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Pending Orders</span>
                    <span class="info-box-number">{{ $pendingOrders }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-check-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Confirmed Orders</span>
                    <span class="info-box-number">{{ $confirmedOrders }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-check-double"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Completed Orders</span>
                    <span class="info-box-number">{{ $completedOrders }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-danger"><i class="fas fa-times-circle"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Cancelled Orders</span>
                    <span class="info-box-number">{{ $cancelledOrders }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Management Row -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-primary"><i class="fas fa-route"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Tours</span>
                    <span class="info-box-number">{{ $totalTours }} <small>({{ $activeTours }} active)</small></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-info"><i class="fas fa-newspaper"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total News</span>
                    <span class="info-box-number">{{ $totalNews }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-success"><i class="fas fa-gift"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Gifts</span>
                    <span class="info-box-number">{{ $totalGifts }}</span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="info-box">
                <span class="info-box-icon bg-warning"><i class="fas fa-bus"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Bus Services</span>
                    <span class="info-box-number">{{ $totalBusServices }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Recent Orders</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-list"></i> View All Orders
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order Code</th>
                                <th>Customer</th>
                                <th>Tour</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td><strong>{{ $order->order_code }}</strong></td>
                                    <td>
                                        <div>{{ $order->customer_name }}</div>
                                        <small class="text-muted">{{ $order->customer_email }}</small>
                                    </td>
                                    <td>{{ $order->tour->name ?? 'N/A' }}</td>
                                    <td><strong>{{ number_format($order->total_price, 0, ',', '.') }} VND</strong></td>
                                    <td>
                                        @if($order->status === 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif($order->status === 'confirmed')
                                            <span class="badge badge-info">Confirmed</span>
                                        @elseif($order->status === 'completed')
                                            <span class="badge badge-success">Completed</span>
                                        @elseif($order->status === 'cancelled')
                                            <span class="badge badge-danger">Cancelled</span>
                                        @else
                                            <span class="badge badge-secondary">{{ ucfirst($order->status ?? 'N/A') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Links -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Quick Actions</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('admin.tours.create') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-plus"></i> Add New Tour
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.news.create') }}" class="btn btn-info btn-block">
                                <i class="fas fa-plus"></i> Add New News
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.gifts.create') }}" class="btn btn-success btn-block">
                                <i class="fas fa-plus"></i> Add New Gift
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="{{ route('admin.bus-services.create') }}" class="btn btn-warning btn-block">
                                <i class="fas fa-plus"></i> Add Bus Service
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Dashboard loaded'); </script>
@stop

