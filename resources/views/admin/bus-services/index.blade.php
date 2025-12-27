@extends('adminlte::page')

@section('title', 'Bus Services')

@section('content_header')
    <h1>Bus Services</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Bus Services</h3>
            <div class="card-tools">
                <a href="{{ route('admin.bus-services.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add New Bus Service
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Departure Time</th>
                        <th>Direction</th>
                        <th>Price</th>
                        <th>Recommended</th>
                        <th>Status</th>
                        <th style="width: 150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($busServices as $service)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($service->image)
                                    <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}" class="img-thumbnail" style="max-width: 80px; max-height: 80px; object-fit: cover;">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>{{ $service->name }}</td>
                            <td>
                                <span class="badge badge-info">{{ ucfirst(str_replace('_', ' ', $service->type)) }}</span>
                            </td>
                            <td>{{ $service->departure_time }}</td>
                            <td>
                                <span class="badge {{ $service->direction === 'outbound' ? 'badge-primary' : 'badge-warning' }}">
                                    {{ ucfirst($service->direction) }}
                                </span>
                            </td>
                            <td>{{ number_format($service->price, 0, ',', '.') }} VND</td>
                            <td>
                                @if($service->is_recommended)
                                    <span class="badge badge-success">Yes</span>
                                @else
                                    <span class="badge badge-secondary">No</span>
                                @endif
                            </td>
                            <td>
                                @if($service->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.bus-services.show', $service) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('admin.bus-services.edit', $service) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <form action="{{ route('admin.bus-services.destroy', $service) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this bus service?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No bus services found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

@php
    use Illuminate\Support\Facades\Storage;
@endphp

