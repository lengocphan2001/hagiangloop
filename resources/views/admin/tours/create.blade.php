@extends('adminlte::page')

@section('title', 'Create Tour')

@section('content_header')
    <h1>Create New Tour</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.tours.store') }}" method="POST" id="tourForm" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Tour Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="duration">Duration <span class="text-danger">*</span></label>
                            <input type="text" name="duration" id="duration" class="form-control @error('duration') is-invalid @enderror" 
                                   value="{{ old('duration') }}" placeholder="4N3Đ" required>
                            @error('duration')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="nights">Nights <span class="text-danger">*</span></label>
                            <input type="number" name="nights" id="nights" class="form-control @error('nights') is-invalid @enderror" 
                                   value="{{ old('nights') }}" min="0" required>
                            @error('nights')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="days">Days <span class="text-danger">*</span></label>
                            <input type="number" name="days" id="days" class="form-control @error('days') is-invalid @enderror" 
                                   value="{{ old('days') }}" min="1" required>
                            @error('days')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="sort_order">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" class="form-control" 
                                   value="{{ old('sort_order', 0) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
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
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="price">Price (VND) <span class="text-danger">*</span></label>
                    <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" 
                           value="{{ old('price') }}" min="0" step="1000" required>
                    @error('price')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="note">Note</label>
                    <x-forms.tinymce-editor name="note" id="note" :value="old('note')" />
                </div>

                <div class="form-group">
                    <label for="thumbnail_image">Thumbnail Image</label>
                    <input type="file" name="thumbnail_image" id="thumbnail_image" class="form-control" accept="image/*">
                    <small class="form-text text-muted">Upload a thumbnail image for this tour (max 2MB)</small>
                </div>

                <div class="form-group">
                    <label for="detail_images">Detail Images</label>
                    <input type="file" name="detail_images[]" id="detail_images" class="form-control" accept="image/*" multiple>
                    <small class="form-text text-muted">Upload multiple detail images for this tour (max 2MB each)</small>
                </div>

                <hr>
                <h4>Tour Days & Locations</h4>
                <div id="daysContainer">
                    <!-- Days will be added here dynamically -->
                </div>
                <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="addDay()">
                    <i class="fas fa-plus"></i> Add Day
                </button>

                <hr>
                <h4>Tour Types</h4>
                <div id="tourTypesContainer">
                    <!-- Tour types will be added here dynamically -->
                </div>
                <button type="button" class="btn btn-secondary btn-sm mt-2" onclick="addTourType()">
                    <i class="fas fa-plus"></i> Add Tour Type
                </button>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Create Tour</button>
                    <a href="{{ route('admin.tours.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
<x-head.tinymce-config selector="#note" upload-url="{{ route('admin.upload-image') }}" api-key="xhvi99zf95ueinybzalp9vwc7yaolsr1rxibrza2dzwb9c8e" />
<script>
let dayCount = 0;
let tourTypeCount = 0;

function addDay(dayData = null) {
    dayCount++;
    const dayNumber = dayData ? dayData.day_number : dayCount;
    const dayHtml = `
        <div class="card mb-3 day-card" data-day-index="${dayCount}">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Day ${dayNumber}</h5>
                <button type="button" class="btn btn-sm btn-danger" onclick="removeDay(this)">
                    <i class="fas fa-trash"></i> Remove Day
                </button>
            </div>
            <div class="card-body">
                <input type="hidden" name="days_data[${dayCount}][day_number]" value="${dayNumber}">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" name="days_data[${dayCount}][title]" class="form-control" 
                                   value="${dayData ? dayData.title : 'Ngày ' + dayNumber}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Route</label>
                            <input type="text" name="days_data[${dayCount}][route]" class="form-control" 
                                   value="${dayData ? dayData.route : ''}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Breakfast Time</label>
                            <input type="time" name="days_data[${dayCount}][breakfast_time]" class="form-control" 
                                   value="${dayData ? dayData.breakfast_time : '08:00'}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Departure Time</label>
                            <input type="time" name="days_data[${dayCount}][departure_time]" class="form-control" 
                                   value="${dayData ? dayData.departure_time : '09:00'}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Notes</label>
                    <textarea name="days_data[${dayCount}][notes]" class="form-control" rows="2">${dayData ? dayData.notes : ''}</textarea>
                </div>
                <hr>
                <h6>Locations</h6>
                <div class="locations-container-${dayCount}">
                    <!-- Locations will be added here -->
                </div>
                <button type="button" class="btn btn-sm btn-secondary" onclick="addLocation(${dayCount})">
                    <i class="fas fa-plus"></i> Add Location
                </button>
            </div>
        </div>
    `;
    document.getElementById('daysContainer').insertAdjacentHTML('beforeend', dayHtml);
    
    // Add locations if dayData exists
    if (dayData && dayData.locations) {
        dayData.locations.forEach((location, index) => {
            addLocation(dayCount, location);
        });
    } else {
        // Add at least one location
        addLocation(dayCount);
    }
}

function addLocation(dayIndex, locationData = null) {
    const locationCount = document.querySelectorAll(`.locations-container-${dayIndex} .location-item`).length + 1;
    const locationHtml = `
        <div class="card mb-2 location-item">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h6 class="mb-0">Location ${locationCount}</h6>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeLocation(this)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" name="days_data[${dayIndex}][locations][${locationCount}][name]" 
                                   class="form-control" value="${locationData ? locationData.name : ''}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Type</label>
                            <select name="days_data[${dayIndex}][locations][${locationCount}][type]" class="form-control">
                                <option value="location" ${locationData && locationData.type === 'location' ? 'selected' : ''}>Location</option>
                                <option value="meal" ${locationData && locationData.type === 'meal' ? 'selected' : ''}>Meal</option>
                                <option value="accommodation" ${locationData && locationData.type === 'accommodation' ? 'selected' : ''}>Accommodation</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Arrival Time</label>
                            <input type="time" name="days_data[${dayIndex}][locations][${locationCount}][arrival_time]" 
                                   class="form-control" value="${locationData ? locationData.arrival_time : ''}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="days_data[${dayIndex}][locations][${locationCount}][description]" 
                              class="form-control" rows="2">${locationData ? locationData.description : ''}</textarea>
                </div>
                <div class="form-group">
                    <label>Thumbnail Image</label>
                    <input type="file" name="days_data[${dayIndex}][locations][${locationCount}][thumbnail_image]" 
                           class="form-control" accept="image/*">
                    ${locationData && locationData.thumbnail_image ? `<img src="/storage/${locationData.thumbnail_image}" class="img-thumbnail mt-2" style="max-width: 200px;">` : ''}
                </div>
                <div class="form-group">
                    <label>Detail Images (Multiple)</label>
                    <input type="file" name="days_data[${dayIndex}][locations][${locationCount}][detail_images][]" 
                           class="form-control" accept="image/*" multiple>
                    <small class="form-text text-muted">You can select multiple images</small>
                    ${locationData && locationData.detail_images && locationData.detail_images.length > 0 ? `
                        <div class="mt-2">
                            ${locationData.detail_images.map(img => `<img src="/storage/${img}" class="img-thumbnail mr-2 mb-2" style="max-width: 150px;">`).join('')}
                        </div>
                    ` : ''}
                </div>
            </div>
        </div>
    `;
    document.querySelector(`.locations-container-${dayIndex}`).insertAdjacentHTML('beforeend', locationHtml);
}

function removeDay(button) {
    if (confirm('Are you sure you want to remove this day? All locations will be deleted.')) {
        button.closest('.day-card').remove();
        updateDayNumbers();
    }
}

function removeLocation(button) {
    button.closest('.location-item').remove();
}

function updateDayNumbers() {
    const dayCards = document.querySelectorAll('.day-card');
    dayCards.forEach((card, index) => {
        const dayNumber = index + 1;
        card.querySelector('h5').textContent = `Day ${dayNumber}`;
        card.querySelector('input[name*="[day_number]"]').value = dayNumber;
    });
}

// Tour Types Management
function addTourType(typeData = null) {
    tourTypeCount++;
    const typeIndex = tourTypeCount;
    const container = document.getElementById('tourTypesContainer');
    
    const typeHtml = `
        <div class="card mb-2 tour-type-item">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h6 class="mb-0">Tour Type ${typeIndex}</h6>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeTourType(this)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" name="tour_types[${typeIndex}][name]" 
                                   class="form-control" value="${typeData ? typeData.name : ''}" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Price (VND) <span class="text-danger">*</span></label>
                            <input type="number" name="tour_types[${typeIndex}][price]" 
                                   class="form-control" value="${typeData ? typeData.price : ''}" min="0" step="1000" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Sort Order</label>
                            <input type="number" name="tour_types[${typeIndex}][sort_order]" 
                                   class="form-control" value="${typeData ? typeData.sort_order : typeIndex}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Status</label>
                            <div class="form-check">
                                <input type="checkbox" name="tour_types[${typeIndex}][is_active]" 
                                       class="form-check-input" value="1" checked>
                                <label class="form-check-label">Active</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', typeHtml);
}

function removeTourType(button) {
    if (confirm('Are you sure you want to remove this tour type?')) {
        button.closest('.tour-type-item').remove();
    }
}

// Initialize with one day
document.addEventListener('DOMContentLoaded', function() {
    addDay();
});
</script>
@stop

