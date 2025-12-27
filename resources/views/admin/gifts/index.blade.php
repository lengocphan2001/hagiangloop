@extends('adminlte::page')

@section('title', 'Gifts')

@section('content_header')
    <h1>Gifts</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of Gifts</h3>
            <div class="card-tools">
                <a href="{{ route('admin.gifts.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add New Gift
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
                        <th>Status</th>
                        <th>Sort Order</th>
                        <th style="width: 150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($gifts as $gift)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($gift->image)
                                    <img src="{{ Storage::url($gift->image) }}" alt="{{ $gift->name }}" class="img-thumbnail" style="max-width: 80px; max-height: 80px; object-fit: cover;">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>{{ $gift->name }}</td>
                            <td>
                                @if($gift->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $gift->sort_order }}</td>
                            <td>
                                <a href="{{ route('admin.gifts.show', $gift) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('admin.gifts.edit', $gift) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <form action="{{ route('admin.gifts.destroy', $gift) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this gift?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No gifts found.</td>
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

