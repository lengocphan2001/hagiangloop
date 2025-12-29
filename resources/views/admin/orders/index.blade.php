@extends('adminlte::page')

@section('title', 'Orders Management')

@section('content_header')
    <h1>Orders Management</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Orders</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Order Code</th>
                        <th>Customer</th>
                        <th>Tour</th>
                        <th>Start Date</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th style="width: 150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                            <td><strong>{{ $order->order_code }}</strong></td>
                            <td>
                                <div>{{ $order->customer_name }}</div>
                                <small class="text-muted">{{ $order->customer_email }}</small>
                            </td>
                            <td>{{ $order->tour->name ?? 'N/A' }}</td>
                            <td>{{ $order->tour_start_date ? $order->tour_start_date->format('d/m/Y') : 'N/A' }}</td>
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
                            <td colspan="9" class="text-center">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
            <div class="card-footer">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@stop

