@extends('adminlte::page')

@section('title', 'Create Home Slide')

@section('content_header')
    <h1>Create New Home Slide</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.home-slides.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                           value="{{ old('title') }}" required placeholder="e.g., Quan Ba Twin Mountain - Fairy Mountain">
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" 
                              rows="4" maxlength="1000" placeholder="Brief description of the slide">{{ old('description') }}</textarea>
                    <small class="form-text text-muted">Max 1000 characters</small>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Image <span class="text-danger">*</span></label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" 
                           accept="image/*" required>
                    <small class="form-text text-muted">Recommended size: 1920x1080px or larger. Max file size: 5MB</small>
                    @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="link">Link URL</label>
                            <input type="url" name="link" id="link" class="form-control @error('link') is-invalid @enderror" 
                                   value="{{ old('link') }}" placeholder="e.g., {{ route('tours.index') }}">
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
                                   value="{{ old('link_text') }}" placeholder="e.g., Discover Tour">
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
                                   value="{{ old('sort_order', 0) }}">
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
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Active</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Slide
                    </button>
                    <a href="{{ route('admin.home-slides.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop
