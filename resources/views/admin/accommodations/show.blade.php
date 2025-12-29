@extends('adminlte::page')

@section('title', 'Accommodation Details')

@section('content_header')
    <h1>Accommodation Details: {{ $accommodation->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Accommodation Information</h3>
                <div>
                    <a href="{{ route('admin.accommodations.edit', $accommodation) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-pencil-alt"></i> Edit
                    </a>
                    <a href="{{ route('admin.accommodations.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <strong>Name:</strong> {{ $accommodation->name }}<br>
                    <strong>Capacity:</strong> {{ $accommodation->capacity_min }}-{{ $accommodation->capacity_max }} persons<br>
                    <strong>Bed Type:</strong> {{ $accommodation->bed_type ?? 'N/A' }}<br>
                </div>
                <div class="col-md-6">
                    <strong>Price per Night:</strong> 
                    @if($accommodation->price_per_night > 0)
                        <strong>{{ number_format($accommodation->price_per_night, 0, ',', '.') }} VND</strong>
                    @else
                        <span class="text-success">Free</span>
                    @endif
                    <br>
                    <strong>Status:</strong> 
                    @if($accommodation->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">Inactive</span>
                    @endif
                    <br>
                    <strong>Sort Order:</strong> {{ $accommodation->sort_order }}
                </div>
            </div>

            @if($accommodation->description)
                <div class="mb-4">
                    <strong>Description:</strong>
                    <p>{{ $accommodation->description }}</p>
                </div>
            @endif
        </div>
    </div>
@stop

