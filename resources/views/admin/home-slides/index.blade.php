@extends('adminlte::page')

@section('title', 'Home Slides')

@section('content_header')
    <h1>Home Slides</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Home Slides</h3>
            <div class="card-tools">
                <a href="{{ route('admin.home-slides.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add New Slide
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Link</th>
                        <th>Sort Order</th>
                        <th>Status</th>
                        <th style="width: 200px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($slides as $slide)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($slide->image)
                                    <img src="{{ Storage::url($slide->image) }}" alt="{{ $slide->title }}" class="img-thumbnail" style="max-width: 100px; max-height: 100px; object-fit: cover;">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td><strong>{{ Str::limit($slide->title, 50) }}</strong></td>
                            <td>{{ Str::limit($slide->description, 80) }}</td>
                            <td>
                                @if($slide->link)
                                    <a href="{{ $slide->link }}" target="_blank" class="text-primary">
                                        {{ Str::limit($slide->link_text ?: $slide->link, 30) }}
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $slide->sort_order }}</td>
                            <td>
                                @if($slide->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.home-slides.show', $slide) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('admin.home-slides.edit', $slide) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <form action="{{ route('admin.home-slides.destroy', $slide) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this slide?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No slides found. <a href="{{ route('admin.home-slides.create') }}">Create your first slide</a></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
