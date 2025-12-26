@extends('adminlte::page')

@section('title', 'News')

@section('content_header')
    <h1>News</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of News</h3>
            <div class="card-tools">
                <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add New News
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Featured Image</th>
                        <th>Status</th>
                        <th>Published At</th>
                        <th>Views</th>
                        <th style="width: 150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>
                                @if($item->featured_image)
                                    <img src="{{ Storage::url($item->featured_image) }}" alt="{{ $item->title }}" class="img-thumbnail" style="max-width: 80px; max-height: 80px;">
                                @else
                                    <span class="text-muted">No image</span>
                                @endif
                            </td>
                            <td>
                                @if($item->is_published)
                                    <span class="badge badge-success">Published</span>
                                @else
                                    <span class="badge badge-danger">Draft</span>
                                @endif
                            </td>
                            <td>
                                @if($item->published_at)
                                    {{ $item->published_at->format('Y-m-d H:i') }}
                                @else
                                    <span class="text-muted">Not set</span>
                                @endif
                            </td>
                            <td>{{ $item->views }}</td>
                            <td>
                                <a href="{{ route('admin.news.show', $item) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this news?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

