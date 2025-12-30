@extends('adminlte::page')

@section('title', 'FAQs')

@section('content_header')
    <h1>Frequently Asked Questions (FAQs)</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">List of FAQs</h3>
            <div class="card-tools">
                <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus"></i> Add New FAQ
                </a>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Status</th>
                        <th>Sort Order</th>
                        <th style="width: 150px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $faq)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ Str::limit($faq->question, 60) }}</strong></td>
                            <td>{{ Str::limit($faq->answer, 80) }}</td>
                            <td>
                                @if($faq->is_active)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $faq->sort_order }}</td>
                            <td>
                                <a href="{{ route('admin.faqs.show', $faq) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <a href="{{ route('admin.faqs.edit', $faq) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this FAQ?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No FAQs found. <a href="{{ route('admin.faqs.create') }}">Create your first FAQ</a></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop

