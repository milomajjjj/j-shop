<x-layout>

<div class="container mt-5" style="max-width: 700px;">

  <!-- Title -->
  <h2 class="mb-4 text-center fw-bold">Edit Product</h2>

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

  <!-- Form Card -->
  <div class="card shadow-sm p-4">

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Name -->
      <div class="mb-3">
        <label class="form-label">Product Name</label>
        <input type="text" name="name" value="{{ $product->name }}" class="form-control" required>
      </div>

      <!-- Description -->
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control" rows="3" required>{{ $product->description }}</textarea>
      </div>

      <!-- Price & Stock -->
      <div class="row">
        <div class="col-md-6 mb-3">
          <label class="form-label">Price ($)</label>
          <input type="number" step="0.01" name="price" value="{{ $product->price }}" class="form-control" required>
        </div>

        <div class="col-md-6 mb-3">
          <label class="form-label">Stock</label>
          <input type="number" name="stock" value="{{ $product->stock }}" class="form-control" required>
        </div>
      </div>

      <!-- Category -->
      <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category_id" class="form-select" required>
          @foreach($categories as $category)
            <option value="{{ $category->id }}"
              {{ $product->category_id == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>

      <!-- Current Image -->
      <div class="mb-3 text-center">
        <label class="form-label d-block">Current Image</label>
        <img src="/assets/images/{{$product->image}}"
             class="img-fluid rounded shadow-sm"
             style="max-height: 150px;">
      </div>

      <!-- Upload New Image -->
      <div class="mb-3">
        <label class="form-label">Change Image</label>
        <input type="file" name="image" class="form-control">
      </div>

      <!-- Button -->
      <button class="btn btn-primary w-100">
        Update Product
      </button>

    </form>

  </div>

</div>

</x-layout>