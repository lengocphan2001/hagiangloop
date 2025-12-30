@extends('adminlte::page')

@section('title', 'FAQ Details')

@section('content_header')
    <h1>FAQ Details</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">FAQ Information</h3>
                <div>
                    <a href="{{ route('admin.faqs.edit', $fAQ) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-pencil-alt"></i> Edit
                    </a>
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <strong>Question:</strong>
                    <p class="mt-2 mb-4 text-lg">{{ $fAQ->question }}</p>
                    
                    <strong>Answer:</strong>
                    <p class="mt-2 mb-4">{{ $fAQ->answer }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <strong>Status:</strong> 
                    @if($fAQ->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">Inactive</span>
                    @endif
                    <br>
                    <strong>Sort Order:</strong> {{ $fAQ->sort_order }}
                </div>
                <div class="col-md-6">
                    <strong>Created At:</strong> {{ $fAQ->created_at->format('Y-m-d H:i:s') }}<br>
                    <strong>Updated At:</strong> {{ $fAQ->updated_at->format('Y-m-d H:i:s') }}
                </div>
            </div>
        </div>
    </div>
@stop

