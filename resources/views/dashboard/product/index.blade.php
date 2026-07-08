{{--
@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Products</h3>
    </div>
</div>
@stop

@section('content')


<form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
    <div class="col-md-5">
        <input type="text" name="search" class="form-control" placeholder="Search products..."
            value="{{ request('search') }}">
    </div>

    <select name="status" class="form-control mx-2">
        <option value="">All Status</option>
        <option value="active" @selected(request('status')=='active' )>Active</option>
        <option value="draft" @selected(request('status')=='draft' )>Draft</option>
        <option value="archived" @selected(request('status')=='archived' )>Archived</option>
    </select>

    <button class="btn btn-dark mx-2">Filter</button>
</form>

<div class="container-fluid">
    <div class="d-flex align-items-center mb-4">
        <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary me-2">Add New Product</a>
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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Store</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>
                                @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product" width="60"
                                    class="rounded">
                                @else
                                <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td class="fw-bold">{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? 'No Category' }}</td>
                            <td>{{ $product->store->name ?? 'No Store' }}</td>
                            <td>{{ number_format($product->price, 2) }}</td>
                            <td>
                                <span
                                    class="badge {{ $product->status == 'active' ? 'bg-success' : ($product->status == 'draft' ? 'bg-warning' : 'bg-secondary') }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>
                            <td>{{ $product->created_at->format('Y-m-d') }}</td>
                            <td class="text-center">
                                <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                    class="btn btn-sm btn-outline-primary">Edit</a>

                                <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST"
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
                            <td colspan="7" class="text-center py-4">No products found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{ $products->withQueryString()->links() }}
</div>
@endsection
--}}
@extends('adminlte::page')

@section('title', 'Products')

@section('content_header')
<div class="row">
    <div class="col-sm-6">
        <h3 class="mb-0">Products</h3>
    </div>
</div>
@stop

@section('content')

    {{-- فلتر البحث --}}
    <form action="{{ URL::current() }}" method="get" class="row mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search products..."
                value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            <select name="category" class="form-control">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="">All Status</option>
                <option value="active" @selected(request('status') == 'active')>Active</option>
                <option value="draft" @selected(request('status') == 'draft')>Draft</option>
                <option value="archived" @selected(request('status') == 'archived')>Archived</option>
            </select>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-dark w-100">Filter</button>
        </div>
    </form>

    <div class="container-fluid">
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary me-2">Add New Product</a>
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
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Store</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>
                                        @if($product->image)
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product" width="60"
                                                class="rounded">
                                        @else
                                            <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold">{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? 'No Category' }}</td>
                                    <td>{{ $product->store->name ?? 'No Store' }}</td>
                                    <td>{{ number_format($product->price, 2) }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $product->status == 'active' ? 'bg-success' : ($product->status == 'draft' ? 'bg-warning' : 'bg-secondary') }}">
                                            {{ ucfirst($product->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $product->created_at->format('Y-m-d') }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('dashboard.products.edit', $product->id) }}"
                                            class="btn btn-sm btn-outline-primary">Edit</a>

                                        <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST"
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
                                    <td colspan="8" class="text-center py-4">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{ $products->withQueryString()->links() }}
    </div>
@endsection