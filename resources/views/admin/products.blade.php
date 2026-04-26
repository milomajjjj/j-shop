<x-layout>

<div class="container mt-5">

  <!-- Title -->
  <h2 class="mb-4 fw-bold text-center">Products Management</h2>

  <!-- Success -->
  @if(session('success'))
    <div class="alert alert-success text-center">
      {{ session('success') }}
    </div>
  @endif

  <!-- Errors -->
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <!-- Add Product Form -->
  <div class="card shadow-sm p-4 mb-5" style="max-width: 700px; margin:auto;">

    <h5 class="mb-3 fw-bold">Add New Product</h5>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3" required></textarea>
      </div>

      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Price ($)</label>
          <input type="number" step="0.01" name="price" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Stock</label>
          <input type="number" name="stock" class="form-control" required>
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select" required>
          <option value="">Select Category</option>
          @foreach($categories as $category)
            <option value="{{ $category->id }}">
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Product Image</label>
        <input type="file" name="image" class="form-control" required>
      </div>

      <button class="btn btn-primary w-100">
        Add Product
      </button>

    </form>

  </div>

  <!-- Products Table -->
  <div class="card shadow-sm p-3">

    <h5 class="mb-3 fw-bold">All Products</h5>

    <div class="table-responsive">
      <table class="table table-hover align-middle">

        <thead class="table-light">
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>

        <tbody>

          @forelse($products as $product)
          <tr>

            <!-- Image -->
            <td>
              <img src="/assets/images/{{$product->image}}" 
                   style="width:50px; height:50px; object-fit:cover;" 
                   class="rounded">
            </td>

            <!-- Name -->
            <td class="fw-bold">{{ $product->name }}</td>

            <!-- Category -->
            <td>{{ $product->category->name ?? '-' }}</td>

            <!-- Price -->
            <td>${{ $product->price }}</td>

            <!-- Stock -->
            <td>
              @if($product->stock == 0)
                <span class="text-danger fw-bold">Out</span>
              @else
                {{ $product->stock }}
              @endif
            </td>

            <!-- Status -->
            <td>
              @if($product->is_active)
                <span class="badge bg-success">Active</span>
              @else
                <span class="badge bg-danger">Hidden</span>
              @endif
            </td>

            <!-- Actions -->
            <td>

              <!-- Edit -->
              <a href="{{ route('admin.products.edit', $product->id) }}" 
                 class="btn btn-sm btn-primary">
                Edit
              </a>

              <!-- Toggle -->
              <form action="{{ route('admin.products.toggle', $product->id) }}" 
                    method="POST" 
                    style="display:inline;">
                @csrf
                <button class="btn btn-sm {{ $product->is_active ? 'btn-warning' : 'btn-success' }}">
                  {{ $product->is_active ? 'Hide' : 'Show' }}
                </button>
              </form>

            </td>

          </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center text-muted">
                No products yet.
              </td>
            </tr>
          @endforelse

        </tbody>

      </table>
    </div>

  </div>

</div>

</x-layout>