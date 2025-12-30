@extends('adminlte::page')

@section('title', 'Order Details')

@section('content_header')
    <h1>Order Details: {{ $order->order_code }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <!-- Order Information -->
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Order Information</h3>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <strong>Order Code:</strong> <span class="badge badge-primary">{{ $order->order_code }}</span><br>
                            <strong>Status:</strong> 
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
                            <br>
                            <strong>Created At:</strong> {{ $order->created_at->format('d/m/Y H:i') }}<br>
                            <strong>Updated At:</strong> {{ $order->updated_at->format('d/m/Y H:i') }}
                        </div>
                        <div class="col-md-6">
                            <strong>Total Price:</strong> <span class="text-success font-weight-bold">{{ number_format($order->total_price, 0, ',', '.') }} VND</span><br>
                            <strong>Tour Start Date:</strong> {{ $order->tour_start_date ? $order->tour_start_date->format('d/m/Y') : 'N/A' }}<br>
                            <strong>Adults:</strong> {{ $order->adults_count }}<br>
                            <strong>Children:</strong> {{ $order->children_count ?? 0 }}
                        </div>
                    </div>

                    <!-- Customer Information -->
                    <div class="mb-4">
                        <h5 class="font-weight-bold">Customer Information</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <strong>Name:</strong> {{ $order->customer_name }}<br>
                                <strong>Email:</strong> {{ $order->customer_email }}<br>
                                <strong>Phone:</strong> {{ $order->customer_phone }}
                            </div>
                            <div class="col-md-6">
                                <strong>Address:</strong> {{ $order->customer_address ?? 'N/A' }}
                            </div>
                        </div>
                    </div>

                    <!-- Additional Passengers -->
                    @php
                        $additionalPassengers = is_array($order->additional_passengers) 
                            ? $order->additional_passengers 
                            : (is_string($order->additional_passengers) ? json_decode($order->additional_passengers, true) : []);
                        $additionalPassengers = $additionalPassengers ?: [];
                    @endphp
                    @if(!empty($additionalPassengers) && is_array($additionalPassengers))
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="font-weight-bold mb-0">Additional Passengers</h5>
                        </div>
                        <div class="card-body">
                            @foreach($additionalPassengers as $index => $passenger)
                            <div class="mb-3 p-3 border rounded">
                                <h6 class="font-weight-bold mb-2">Passenger {{ $index + 2 }}</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Name:</strong> {{ $passenger['name'] ?? 'N/A' }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Country:</strong> {{ $passenger['country'] ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Tour Information -->
                    <div class="mb-4">
                        <h5 class="font-weight-bold">Tour Information</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <strong>Tour:</strong> {{ $order->tour->name ?? 'N/A' }}<br>
                                @if($order->tour)
                                    <strong>Duration:</strong> {{ $order->tour->days }}D/{{ $order->tour->nights }}N<br>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Bus Services -->
                    @if($order->outbound_bus_service_id || $order->return_bus_service_id)
                        <div class="mb-4">
                            <h5 class="font-weight-bold">Bus Services</h5>
                            <hr>
                            @if($order->outboundBusService)
                                <div class="mb-4 p-3 border rounded">
                                    <h6 class="font-weight-bold mb-3">Outbound</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Service Name:</strong> {{ $order->outboundBusService->name }}<br>
                                            <strong>Type:</strong> {{ ucfirst(str_replace('_', ' ', $order->outboundBusService->type)) }}<br>
                                            <strong>Departure Time:</strong> {{ $order->outboundBusService->departure_time }}<br>
                                            <strong>Starting Point:</strong> {{ $order->outboundBusService->starting_point ?? 'N/A' }}<br>
                                            <strong>Price:</strong> <span class="text-success font-weight-bold">{{ number_format($order->outboundBusService->price, 0, ',', '.') }} VND</span>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Pick-up Location:</strong><br>
                                            <p class="text-muted">{{ $order->outboundBusService->pick_up_location ?? 'N/A' }}</p>
                                            @if($order->outboundBusService->image)
                                                <img src="{{ asset('storage/' . $order->outboundBusService->image) }}" alt="{{ $order->outboundBusService->name }}" style="max-width: 200px; max-height: 150px; object-fit: cover;" class="img-thumbnail mt-2">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @if($order->returnBusService)
                                <div class="mb-4 p-3 border rounded">
                                    <h6 class="font-weight-bold mb-3">Return</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <strong>Service Name:</strong> {{ $order->returnBusService->name }}<br>
                                            <strong>Type:</strong> {{ ucfirst(str_replace('_', ' ', $order->returnBusService->type)) }}<br>
                                            <strong>Departure Time:</strong> {{ $order->returnBusService->departure_time }}<br>
                                            <strong>Return Destination:</strong> {{ $order->returnBusService->return_destination ?? 'N/A' }}<br>
                                            <strong>Price:</strong> <span class="text-success font-weight-bold">{{ number_format($order->returnBusService->price, 0, ',', '.') }} VND</span>
                                        </div>
                                        <div class="col-md-6">
                                            <strong>Pick-up Location:</strong><br>
                                            <p class="text-muted">{{ $order->returnBusService->pick_up_location ?? 'N/A' }}</p>
                                            @if($order->returnBusService->image)
                                                <img src="{{ asset('storage/' . $order->returnBusService->image) }}" alt="{{ $order->returnBusService->name }}" style="max-width: 200px; max-height: 150px; object-fit: cover;" class="img-thumbnail mt-2">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Gift -->
                    @if($order->gift)
                        <div class="mb-4">
                            <h5 class="font-weight-bold">Gift</h5>
                            <hr>
                            <div>{{ $order->gift->name }}</div>
                            @if($order->gift->image)
                                <img src="{{ asset('storage/' . $order->gift->image) }}" alt="{{ $order->gift->name }}" style="max-width: 150px; max-height: 150px; object-fit: cover;" class="img-thumbnail mt-2">
                            @endif
                        </div>
                    @endif

                    <!-- Notes -->
                    @if($order->notes)
                        <div class="mb-4">
                            <h5 class="font-weight-bold">Notes</h5>
                            <hr>
                            <p>{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Status Update -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Update Status</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-save"></i> Update Status
                        </button>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Order Summary</h3>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <tr>
                            <td>Tour:</td>
                            <td class="text-right">{{ number_format($order->total_price - ($order->outboundBusService->price ?? 0) - ($order->returnBusService->price ?? 0), 0, ',', '.') }} VND</td>
                        </tr>
                        @if($order->outboundBusService)
                            <tr>
                                <td>Outbound Bus:</td>
                                <td class="text-right">{{ number_format($order->outboundBusService->price, 0, ',', '.') }} VND</td>
                            </tr>
                        @endif
                        @if($order->returnBusService)
                            <tr>
                                <td>Return Bus:</td>
                                <td class="text-right">{{ number_format($order->returnBusService->price, 0, ',', '.') }} VND</td>
                            </tr>
                        @endif
                        <tr class="font-weight-bold">
                            <td>Total:</td>
                            <td class="text-right text-success">{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

