@extends('adminlte::page');
@section('title', 'categories');
@section('content_header')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">categories</h3>
    </div>
</div>
@stop
@section('content')


    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary">Add New Category</a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>

                                <th>Name</th>
                                <th>Description</th>
                                <th>Parent</th>
                                <th>Status</th>
                                <th class="ps-4">Image</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>

                                    <td class="fw-bold">{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->parent->name ?? '---' }}</td>

                                    <td>
                                        <span class="badge {{ $category->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                            {{ ucfirst($category->status) }}
                                        </span>
                                    </td>

                                    <td class="ps-4">
                                        @if($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}" alt="Category Image" width="50"
                                                class="rounded">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                                            class="btn btn-sm btn-outline-primary">Edit</a>

                                        <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4">No categories found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer">
            </div>
        </div>
    </div>
@endsection