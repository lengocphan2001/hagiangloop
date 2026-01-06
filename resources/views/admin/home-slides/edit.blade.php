@extends('adminlte::page')

@section('title', 'Edit Home Slide')

@section('content_header')
    <h1>Edit Home Slide: {{ Str::limit($homeSlide->title, 50) }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.home-slides.update', ['home_slide' => $homeSlide->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                           value="{{ old('title', $homeSlide->title) }}" required placeholder="e.g., Quan Ba Twin Mountain - Fairy Mountain">
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" 
                              rows="4" maxlength="1000" placeholder="Brief description of the slide">{{ old('description', $homeSlide->description) }}</textarea>
                    <small class="form-text text-muted">Max 1000 characters</small>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    @if($homeSlide->image)
                        <div class="mb-2">
                            <img src="{{ Storage::url($homeSlide->image) }}" alt="{{ $homeSlide->title }}" class="img-thumbnail" style="max-width: 300px; max-height: 200px; object-fit: cover;">
                            <p class="text-muted mt-1">Current image</p>
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" 
                           accept="image/*">
                    <small class="form-text text-muted">Upload new image to replace current one. Recommended size: 1920x1080px or larger. Max file size: 5MB</small>
                    @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="link">Link URL</label>
                            <input type="url" name="link" id="link" class="form-control @error('link') is-invalid @enderror" 
                                   value="{{ old('link', $homeSlide->link) }}" placeholder="e.g., {{ route('tours.index') }}">
                            <small class="form-text text-muted">Optional: URL to redirect when slide is clicked</small>
                            @error('link')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="link_text">Link Text</label>
                            <input type="text" name="link_text" id="link_text" class="form-control @error('link_text') is-invalid @enderror" 
                                   value="{{ old('link_text', $homeSlide->link_text) }}" placeholder="e.g., Discover Tour">
                            <small class="form-text text-muted">Text for the link button (optional)</small>
                            @error('link_text')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sort_order">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" 
                                   value="{{ old('sort_order', $homeSlide->sort_order) }}">
                            <small class="form-text text-muted">Lower numbers appear first</small>
                            @error('sort_order')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="is_active">Status</label>
                            <div class="form-check">
                                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" 
                                       {{ old('is_active', $homeSlide->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Slide
                    </button>
                    <a href="{{ route('admin.home-slides.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop
