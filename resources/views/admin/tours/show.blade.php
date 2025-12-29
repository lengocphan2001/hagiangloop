@extends('adminlte::page')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('title', 'Tour Details')

@section('content_header')
    <h1>Tour Details: {{ $tour->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Tour Information</h3>
                <div>
                    <a href="{{ route('admin.tours.edit', $tour) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-pencil-alt"></i> Edit
                    </a>
                    <a href="{{ route('admin.tours.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <strong>Name:</strong> {{ $tour->name }}<br>
                    <strong>Duration:</strong> {{ $tour->duration }}<br>
                    <strong>Days/Nights:</strong> {{ $tour->days }}D/{{ $tour->nights }}N<br>
                </div>
                <div class="col-md-6">
                    <strong>Status:</strong> 
                    @if($tour->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">Inactive</span>
                    @endif
                    <br>
                    <strong>Sort Order:</strong> {{ $tour->sort_order }}
                </div>
            </div>

            @if($tour->description)
                <div class="mb-4">
                    <strong>Description:</strong>
                    <p>{{ $tour->description }}</p>
                </div>
            @endif

            @if($tour->thumbnail_image)
                <div class="mb-4">
                    <strong>Thumbnail Image:</strong>
                    <div class="mt-2">
                        <img src="{{ Storage::url($tour->thumbnail_image) }}" alt="Tour thumbnail" style="max-width: 300px; max-height: 300px; object-fit: cover;" class="img-thumbnail">
                    </div>
                </div>
            @endif

            @if($tour->detail_images && count($tour->detail_images) > 0)
                <div class="mb-4">
                    <strong>Detail Images:</strong>
                    <div class="d-flex flex-wrap gap-2 mt-2">
                        @foreach($tour->detail_images as $image)
                            <img src="{{ Storage::url($image) }}" alt="Detail image" style="max-width: 200px; max-height: 200px; object-fit: cover;" class="img-thumbnail">
                        @endforeach
                    </div>
                </div>
            @endif

            @if($tour->note)
                <div class="mb-4">
                    <strong>Note:</strong>
                    <div class="mt-2">
                        {!! $tour->note !!}
                    </div>
                </div>
            @endif

            <hr>

            <h4>Tour Itinerary</h4>
            @foreach($tour->tourDays as $day)
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">{{ $day->title }}</h5>
                        @if($day->route)
                            <small>{{ $day->route }}</small>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            @if($day->breakfast_time)
                                <div class="col-md-4">
                                    <strong>Breakfast:</strong> {{ $day->breakfast_time->format('H:i') }}
                                </div>
                            @endif
                            @if($day->departure_time)
                                <div class="col-md-4">
                                    <strong>Departure:</strong> {{ $day->departure_time->format('H:i') }}
                                </div>
                            @endif
                        </div>
                        @if($day->notes)
                            <div class="mb-3">
                                <strong>Notes:</strong> {{ $day->notes }}
                            </div>
                        @endif
                        <h6>Locations:</h6>
                        <ul class="list-group">
                            @foreach($day->locations as $location)
                                <li class="list-group-item">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <strong>{{ $location->name }}</strong>
                                            @if($location->type)
                                                <span class="badge badge-info ml-2">{{ ucfirst($location->type) }}</span>
                                            @endif
                                            @if($location->arrival_time)
                                                <small class="text-muted ml-2">{{ $location->arrival_time->format('H:i') }}</small>
                                            @endif
                                            @if($location->description)
                                                <p class="mb-2 mt-1">{{ $location->description }}</p>
                                            @endif
                                            
                                            @if($location->thumbnail_image)
                                                <div class="mb-2">
                                                    <strong>Thumbnail:</strong><br>
                                                    <img src="{{ asset('storage/' . $location->thumbnail_image) }}" 
                                                         alt="{{ $location->name }}" 
                                                         class="img-thumbnail" 
                                                         style="max-width: 200px;">
                                                </div>
                                            @endif
                                            
                                            @if($location->detail_images && count($location->detail_images) > 0)
                                                <div class="mb-2">
                                                    <strong>Detail Images:</strong><br>
                                                    <div class="d-flex flex-wrap mt-2" style="gap: 10px;">
                                                        @foreach($location->detail_images as $detailImage)
                                                            <img src="{{ asset('storage/' . $detailImage) }}" 
                                                                 alt="{{ $location->name }}" 
                                                                 class="img-thumbnail" 
                                                                 style="max-width: 150px; cursor: pointer;"
                                                                 onclick="window.open('{{ asset('storage/' . $detailImage) }}', '_blank')">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@stop

