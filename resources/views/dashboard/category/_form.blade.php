<div class="container">
    <div class="card shadow-sm">
        <div class="card-header bg-white py-3">
            <h4 class="mb-0">{{ $category->exists ? 'Edit Category' : 'Create Category' }}</h4>
        </div>
        <div class="card-body">

            <form
                action="{{ $category->exists ? route('dashboard.categories.update', $category->id) : route('dashboard.categories.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf

                @if($category->exists)
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}"
                        required>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Parent Category</label>
                    <select name="parent_id" class="form-select">
                        <option value="">No Parent (Root)</option>
                        @foreach($parents as $parent)
                            <option value="{{ $parent->id }}" {{ $category->parent_id == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('parent_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control"
                        rows="3">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Category Image</label>
                    @if($category->image)
                        <div class="mb-2"><img src="{{ asset('storage/' . $category->image) }}" width="80"></div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @error('image')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        {{ $category->exists ? 'Update Category' : 'Save Category' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>