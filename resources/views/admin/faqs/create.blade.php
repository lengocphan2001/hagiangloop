@extends('adminlte::page')

@section('title', 'Create FAQ')

@section('content_header')
    <h1>Create New FAQ</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.faqs.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="question">Question <span class="text-danger">*</span></label>
                    <input type="text" name="question" id="question" class="form-control @error('question') is-invalid @enderror" 
                           value="{{ old('question') }}" required placeholder="e.g., Can I pay by card?">
                    @error('question')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="answer">Answer <span class="text-danger">*</span></label>
                    <textarea name="answer" id="answer" class="form-control @error('answer') is-invalid @enderror" 
                              rows="5" required placeholder="Enter the answer...">{{ old('answer') }}</textarea>
                    @error('answer')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sort_order">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" 
                           value="{{ old('sort_order', 0) }}">
                    @error('sort_order')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" 
                               {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create FAQ
                    </button>
                    <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

