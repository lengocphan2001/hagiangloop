@extends('adminlte::page')

@section('title', 'Create Bus Service')

@section('content_header')
    <h1>Create New Bus Service</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.bus-services.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" placeholder="e.g., VIP CABIN, LUXURY BUS" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">Type <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                                <option value="">Select Type</option>
                                <option value="vip_cabin" {{ old('type') === 'vip_cabin' ? 'selected' : '' }}>VIP Cabin</option>
                                <option value="luxury_bus" {{ old('type') === 'luxury_bus' ? 'selected' : '' }}>Luxury Bus</option>
                                <option value="limousine_bus" {{ old('type') === 'limousine_bus' ? 'selected' : '' }}>Limousine Bus</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="departure_time">Departure Time <span class="text-danger">*</span></label>
                            <input type="text" name="departure_time" id="departure_time" class="form-control @error('departure_time') is-invalid @enderror" 
                                   value="{{ old('departure_time') }}" placeholder="e.g., 11AM, 7:30PM" required>
                            @error('departure_time')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Price (VND) <span class="text-danger">*</span></label>
                            <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" 
                                   value="{{ old('price') }}" min="0" step="1000" required>
                            @error('price')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pick_up_location">Pick Up Location <span class="text-danger">*</span></label>
                    <textarea name="pick_up_location" id="pick_up_location" class="form-control @error('pick_up_location') is-invalid @enderror" 
                              rows="2" required>{{ old('pick_up_location') }}</textarea>
                    <small class="form-text text-muted">e.g., 162 Tran Quang Khai street or Alley Homestay</small>
                    @error('pick_up_location')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="direction">Direction <span class="text-danger">*</span></label>
                            <select name="direction" id="direction" class="form-control @error('direction') is-invalid @enderror" required>
                                <option value="outbound" {{ old('direction', 'outbound') === 'outbound' ? 'selected' : '' }}>Outbound</option>
                                <option value="return" {{ old('direction') === 'return' ? 'selected' : '' }}>Return</option>
                            </select>
                            @error('direction')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="starting_point">Starting Point</label>
                            <input type="text" name="starting_point" id="starting_point" class="form-control @error('starting_point') is-invalid @enderror" 
                                   value="{{ old('starting_point') }}" placeholder="e.g., HANOI">
                            <small class="form-text text-muted">For outbound direction</small>
                            @error('starting_point')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="return_destination">Return Destination</label>
                    <input type="text" name="return_destination" id="return_destination" class="form-control @error('return_destination') is-invalid @enderror" 
                           value="{{ old('return_destination') }}" placeholder="e.g., HA LONG">
                    <small class="form-text text-muted">For return direction</small>
                    @error('return_destination')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" 
                           accept="image/*">
                    <small class="form-text text-muted">Upload an image for this bus service (max 2MB)</small>
                    @error('image')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="sort_order">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" class="form-control @error('sort_order') is-invalid @enderror" 
                                   value="{{ old('sort_order', 0) }}">
                            @error('sort_order')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-check mt-4">
                                <input type="checkbox" name="is_recommended" id="is_recommended" class="form-check-input" value="1" 
                                       {{ old('is_recommended') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_recommended">
                                    Recommended
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="form-check mt-4">
                                <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" 
                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Active
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Bus Service
                    </button>
                    <a href="{{ route('admin.bus-services.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

