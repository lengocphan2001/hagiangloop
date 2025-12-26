@extends('adminlte::page')

@section('title', 'Create News')

@section('content_header')
    <h1>Create New News</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="title">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                           value="{{ old('title') }}" required>
                    @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="slug">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-control @error('slug') is-invalid @enderror" 
                           value="{{ old('slug') }}" placeholder="Auto-generated from title if empty">
                    @error('slug')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="excerpt">Excerpt</label>
                    <textarea name="excerpt" id="excerpt" class="form-control @error('excerpt') is-invalid @enderror" 
                              rows="3" maxlength="500">{{ old('excerpt') }}</textarea>
                    <small class="form-text text-muted">Brief summary of the news (max 500 characters)</small>
                    @error('excerpt')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <x-forms.tinymce-editor name="content" id="content" :value="old('content')" />
                    @error('content')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="featured_image">Featured Image</label>
                    <input type="file" name="featured_image" id="featured_image" class="form-control @error('featured_image') is-invalid @enderror" 
                           accept="image/*">
                    <small class="form-text text-muted">Recommended size: 1200x630px</small>
                    @error('featured_image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" class="form-control" 
                                   value="{{ old('meta_title') }}" maxlength="255">
                            <small class="form-text text-muted">SEO meta title (max 255 characters)</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="is_published">Status</label>
                            <div class="form-check">
                                <input type="checkbox" name="is_published" id="is_published" class="form-check-input" value="1" 
                                       {{ old('is_published', false) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_published">Published</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="meta_description">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" class="form-control" rows="3" maxlength="500">{{ old('meta_description') }}</textarea>
                    <small class="form-text text-muted">SEO meta description (max 500 characters)</small>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="published_at">Published At</label>
                            <input type="datetime-local" name="published_at" id="published_at" class="form-control" 
                                   value="{{ old('published_at') }}">
                            <small class="form-text text-muted">Schedule publication date (optional)</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sort_order">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" class="form-control" 
                                   value="{{ old('sort_order') }}">
                            <small class="form-text text-muted">Lower numbers appear first</small>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Create News</button>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
    <x-head.tinymce-config selector="#content" upload-url="{{ route('admin.upload-image') }}" api-key="xhvi99zf95ueinybzalp9vwc7yaolsr1rxibrza2dzwb9c8e" />
@stop

