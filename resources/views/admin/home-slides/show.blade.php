@extends('adminlte::page')

@section('title', 'Home Slide Details')

@section('content_header')
    <h1>Home Slide Details</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Slide Information</h3>
                <div>
                    <a href="{{ route('admin.home-slides.edit', $homeSlide) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-pencil-alt"></i> Edit
                    </a>
                    <a href="{{ route('admin.home-slides.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    @if($homeSlide->image)
                        <img src="{{ Storage::url($homeSlide->image) }}" alt="{{ $homeSlide->title }}" class="img-fluid rounded mb-4" style="max-height: 400px; object-fit: cover;">
                    @endif
                    <strong>Title:</strong>
                    <p class="mt-2 mb-4 text-lg">{{ $homeSlide->title }}</p>
                    
                    <strong>Description:</strong>
                    <p class="mt-2 mb-4">{{ $homeSlide->description ?: 'No description' }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <strong>Link:</strong> 
                    @if($homeSlide->link)
                        <a href="{{ $homeSlide->link }}" target="_blank" class="d-block mt-1">{{ $homeSlide->link }}</a>
                    @else
                        <span class="text-muted d-block mt-1">No link</span>
                    @endif
                    <br>
                    <strong>Link Text:</strong> {{ $homeSlide->link_text ?: '-' }}<br>
                    <strong>Sort Order:</strong> {{ $homeSlide->sort_order }}
                </div>
                <div class="col-md-6">
                    <strong>Status:</strong> 
                    @if($homeSlide->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">Inactive</span>
                    @endif
                    <br>
                    <strong>Created At:</strong> {{ $homeSlide->created_at->format('Y-m-d H:i:s') }}<br>
                    <strong>Updated At:</strong> {{ $homeSlide->updated_at->format('Y-m-d H:i:s') }}
                </div>
            </div>
        </div>
    </div>
@stop
