@extends('adminlte::page')

@section('title', 'Bus Service Details')

@section('content_header')
    <h1>Bus Service Details: {{ $busService->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Bus Service Information</h3>
                <div>
                    <a href="{{ route('admin.bus-services.edit', $busService) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-pencil-alt"></i> Edit
                    </a>
                    <a href="{{ route('admin.bus-services.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <strong>Name:</strong> {{ $busService->name }}<br>
                    <strong>Type:</strong> 
                    <span class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $busService->type)) }}</span><br>
                    <strong>Departure Time:</strong> {{ $busService->departure_time }}<br>
                    <strong>Pick Up Location:</strong> {{ $busService->pick_up_location }}<br>
                    <strong>Price:</strong> {{ number_format($busService->price, 0, ',', '.') }} VND<br>
                </div>
                <div class="col-md-6">
                    <strong>Direction:</strong> 
                    <span class="badge {{ $busService->direction === 'outbound' ? 'badge-primary' : 'badge-warning' }}">
                        {{ ucfirst($busService->direction) }}
                    </span><br>
                    @if($busService->starting_point)
                        <strong>Starting Point:</strong> {{ $busService->starting_point }}<br>
                    @endif
                    @if($busService->return_destination)
                        <strong>Return Destination:</strong> {{ $busService->return_destination }}<br>
                    @endif
                    <strong>Recommended:</strong> 
                    @if($busService->is_recommended)
                        <span class="badge badge-success">Yes</span>
                    @else
                        <span class="badge badge-secondary">No</span>
                    @endif<br>
                    <strong>Status:</strong> 
                    @if($busService->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">Inactive</span>
                    @endif<br>
                    <strong>Sort Order:</strong> {{ $busService->sort_order }}<br>
                    <strong>Created At:</strong> {{ $busService->created_at->format('Y-m-d H:i:s') }}<br>
                    <strong>Updated At:</strong> {{ $busService->updated_at->format('Y-m-d H:i:s') }}
                </div>
            </div>

            @if($busService->image)
                <div class="mb-4">
                    <strong>Image:</strong>
                    <div class="mt-2">
                        <img src="{{ Storage::url($busService->image) }}" alt="{{ $busService->name }}" class="img-thumbnail" style="max-width: 300px; max-height: 300px; object-fit: cover;">
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop

@php
    use Illuminate\Support\Facades\Storage;
@endphp

