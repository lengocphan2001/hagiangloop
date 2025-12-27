@extends('adminlte::page')

@section('title', 'Gift Details')

@section('content_header')
    <h1>Gift Details: {{ $gift->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">Gift Information</h3>
                <div>
                    <a href="{{ route('admin.gifts.edit', $gift) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-pencil-alt"></i> Edit
                    </a>
                    <a href="{{ route('admin.gifts.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <strong>Name:</strong> {{ $gift->name }}<br>
                    <strong>Sort Order:</strong> {{ $gift->sort_order }}<br>
                </div>
                <div class="col-md-6">
                    <strong>Status:</strong> 
                    @if($gift->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">Inactive</span>
                    @endif
                    <br>
                    <strong>Created At:</strong> {{ $gift->created_at->format('Y-m-d H:i:s') }}<br>
                    <strong>Updated At:</strong> {{ $gift->updated_at->format('Y-m-d H:i:s') }}
                </div>
            </div>

            @if($gift->image)
                <div class="mb-4">
                    <strong>Image:</strong>
                    <div class="mt-2">
                        <img src="{{ Storage::url($gift->image) }}" alt="{{ $gift->name }}" class="img-thumbnail" style="max-width: 300px; max-height: 300px; object-fit: cover;">
                    </div>
                </div>
            @endif
        </div>
    </div>
@stop

@php
    use Illuminate\Support\Facades\Storage;
@endphp

