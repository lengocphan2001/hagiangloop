@extends('adminlte::page')

@section('title', 'Edit Accommodation')

@section('content_header')
    <h1>Edit Accommodation: {{ $accommodation->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.accommodations.update', $accommodation) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $accommodation->name) }}" required placeholder="e.g., Dorm, Private room (1-2pp), Family room (3-4pp)">
                    @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" 
                              rows="3">{{ old('description', $accommodation->description) }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="capacity_min">Capacity Min (persons) <span class="text-danger">*</span></label>
                            <input type="number" name="capacity_min" id="capacity_min" class="form-control @error('capacity_min') is-invalid @enderror" 
                                   value="{{ old('capacity_min', $accommodation->capacity_min) }}" min="1" required>
                            @error('capacity_min')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="capacity_max">Capacity Max (persons) <span class="text-danger">*</span></label>
                            <input type="number" name="capacity_max" id="capacity_max" class="form-control @error('capacity_max') is-invalid @enderror" 
                                   value="{{ old('capacity_max', $accommodation->capacity_max) }}" min="1" required>
                            @error('capacity_max')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="bed_type">Bed Type</label>
                    <input type="text" name="bed_type" id="bed_type" class="form-control @error('bed_type') is-invalid @enderror" 
                           value="{{ old('bed_type', $accommodation->bed_type) }}" placeholder="e.g., 1 king bed, 2 king beds">
                    @error('bed_type')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="price_per_night">Price per Night (VND) <span class="text-danger">*</span></label>
                    <input type="number" name="price_per_night" id="price_per_night" class="form-control @error('price_per_night') is-invalid @enderror" 
                           value="{{ old('price_per_night', $accommodation->price_per_night) }}" min="0" required>
                    <small class="form-text text-muted">Enter 0 for free accommodation (e.g., Dorm)</small>
                    @error('price_per_night')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="sort_order">Sort Order</label>
                    <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" 
                           value="{{ old('sort_order', $accommodation->sort_order) }}">
                    @error('sort_order')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="form-check">
                        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" 
                               {{ old('is_active', $accommodation->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Accommodation
                    </button>
                    <a href="{{ route('admin.accommodations.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

