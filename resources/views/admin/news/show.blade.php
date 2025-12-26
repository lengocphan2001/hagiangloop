@extends('adminlte::page')

@section('title', 'News Details')

@section('content_header')
    <h1>News Details: {{ $news->title }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="card-title">News Information</h3>
                <div>
                    <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-pencil-alt"></i> Edit
                    </a>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <strong>Title:</strong> {{ $news->title }}<br>
                    <strong>Slug:</strong> {{ $news->slug }}<br>
                    <strong>Status:</strong> 
                    @if($news->is_published)
                        <span class="badge badge-success">Published</span>
                    @else
                        <span class="badge badge-danger">Draft</span>
                    @endif
                    <br>
                    <strong>Published At:</strong> 
                    @if($news->published_at)
                        {{ $news->published_at->format('Y-m-d H:i') }}
                    @else
                        <span class="text-muted">Not set</span>
                    @endif
                    <br>
                    <strong>Views:</strong> {{ $news->views }}<br>
                    <strong>Sort Order:</strong> {{ $news->sort_order ?? 'Not set' }}
                </div>
                <div class="col-md-6">
                    @if($news->featured_image)
                        <strong>Featured Image:</strong><br>
                        <img src="{{ Storage::url($news->featured_image) }}" alt="{{ $news->title }}" class="img-thumbnail mt-2" style="max-width: 300px;">
                    @endif
                </div>
            </div>

            @if($news->excerpt)
                <div class="mb-4">
                    <strong>Excerpt:</strong>
                    <p>{{ $news->excerpt }}</p>
                </div>
            @endif

            @if($news->content)
                <div class="mb-4">
                    <strong>Content:</strong>
                    <div class="border p-3 mt-2" style="max-height: 400px; overflow-y: auto;">
                        {!! $news->content !!}
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6">
                    <strong>Meta Title:</strong> {{ $news->meta_title ?? 'Not set' }}<br>
                </div>
                <div class="col-md-6">
                    <strong>Meta Description:</strong> {{ $news->meta_description ?? 'Not set' }}
                </div>
            </div>
        </div>
    </div>
@stop

