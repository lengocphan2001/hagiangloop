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
                    <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-warning btn-sm">
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
                    <p class="mt-2 mb-4 text-lg">{{ $faq->question }}</p>
                    
                    <strong>Answer:</strong>
                    <p class="mt-2 mb-4">{{ $faq->answer }}</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <strong>Status:</strong> 
                    @if($faq->is_active)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge badge-danger">Inactive</span>
                    @endif
                    <br>
                    <strong>Sort Order:</strong> {{ $faq->sort_order }}
                </div>
                <div class="col-md-6">
                    <strong>Created At:</strong> {{ $faq->created_at->format('Y-m-d H:i:s') }}<br>
                    <strong>Updated At:</strong> {{ $faq->updated_at->format('Y-m-d H:i:s') }}
                </div>
            </div>
        </div>
    </div>
@stop

