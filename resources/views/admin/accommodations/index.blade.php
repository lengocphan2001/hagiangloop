@extends('adminlte::page')

@section('title', 'Accommodations')

@section('content_header')
    <h1>Accommodations</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Accommodations</h3>
            <div class="card-tools">
                <a href="{{ route('admin.accommodations.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add New Accommodation
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Capacity</th>
                        <th>Bed Type</th>
                        <th>Price/Night</th>
                        <th>Status</th>
                        <th>Sort Order</th>
                        <th style="width: 150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($accommodations as $accommodation)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $accommodation->name }}</strong></td>
                            <td>{{ $accommodation->capacity_min }}-{{ $accommodation->capacity_max }}pp</td>
                            <td>{{ $accommodation->bed_type ?? 'N/A' }}</td>
                            <td>
                                @if($accommodation->price_per_night > 0)
                                    <strong>{{ number_format($accommodation->price_per_night, 0, ',', '.') }} VND</strong>
                                @else
                                    <span class="text-success">Free</span>
                                @endif
                            </td>
                            <td>
                                @if($accommodation->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $accommodation->sort_order }}</td>
                            <td>
                                <a href="{{ route('admin.accommodations.show', $accommodation) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('admin.accommodations.edit', $accommodation) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <form action="{{ route('admin.accommodations.destroy', $accommodation) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this accommodation?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No accommodations found. <a href="{{ route('admin.accommodations.create') }}">Create your first accommodation</a></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

