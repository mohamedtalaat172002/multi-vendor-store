@extends('adminlte::page')
@section('title', 'categories')
@section('content_header')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Trashed</h3>
    </div>
</div>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Trashed Categories</h3>
                        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-secondary btn-sm">Back to
                            Categories</a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if($categories->count())
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Deleted At</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{{ optional($category->deleted_at)->format('Y-m-d H:i') }}</td>
                                                <td class="text-center">
                                                    <form action="{{ route('dashboard.categories.restore', $category->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                                    </form>

                                                    <form action="{{ route('dashboard.categories.force-delete', $category->id) }}"
                                                        method="POST" class="d-inline"
                                                        onsubmit="return confirm('Are you sure you want to permanently delete this category?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Force Delete</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info mb-0">No trashed categories available.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection