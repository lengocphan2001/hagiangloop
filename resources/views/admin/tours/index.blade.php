@extends('adminlte::page')

@section('title', 'Tours Management')

@section('content_header')
    <h1>Tours Management</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Tours</h3>
            <div class="card-tools">
                <a href="{{ route('admin.tours.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add New Tour
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Duration</th>
                        <th>Days/Nights</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th style="width: 150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tours as $tour)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tour->name }}</td>
                            <td>{{ $tour->duration }}</td>
                            <td>{{ $tour->days }}D/{{ $tour->nights }}N</td>
                            <td>{{ $tour->price ? number_format($tour->price, 0) . ' VND' : 'N/A' }}</td>
                            <td>
                                @if($tour->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.tours.show', $tour) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('admin.tours.edit', $tour) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <form action="{{ route('admin.tours.destroy', $tour) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this tour?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No tours found. <a href="{{ route('admin.tours.create') }}">Create your first tour</a></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

