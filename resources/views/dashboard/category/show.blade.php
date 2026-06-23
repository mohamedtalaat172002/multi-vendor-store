@extends('adminlte::page');

@section('content')
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Category Details</h4>
                <a href="{{ route('dashboard.categories.index') }}" class="btn btn-sm btn-outline-secondary">Back to
                    List</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" class="img-fluid rounded shadow-sm"
                                alt="{{ $category->name }}">
                        @else
                            <div class="bg-light p-5 rounded">No Image</div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h3>{{ $category->name }}</h3>
                        <p class="text-muted">Slug: <code>{{ $category->slug }}</code></p>
                        <hr>
                        <p><strong>Parent:</strong> {{ $category->parent->name ?? '---' }}</p>
                        <p><strong>Status:</strong>
                            <span class="badge {{ $category->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($category->status) }}
                            </span>
                        </p>
                        <p><strong>Description:</strong></p>
                        <p class="bg-light p-3 rounded">{{ $category->description ?: 'No description provided.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection