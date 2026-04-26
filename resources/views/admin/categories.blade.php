<x-layout>

<div class="container mt-5" style="max-width: 700px;">

  <!-- Title -->
  <h2 class="mb-4 text-center fw-bold">Manage Categories</h2>

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

  <!-- Add Category -->
  <div class="card shadow-sm p-4 mb-4">
    <form method="POST" action="{{ route('admin.categories.store') }}">
      @csrf

      <div class="mb-3">
        <label class="form-label">Category Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter category name" required>
      </div>

      <button class="btn btn-primary w-100">
        Add Category
      </button>

    </form>
  </div>

  <!-- Categories List -->
  <div class="card shadow-sm p-3">

    <h5 class="mb-3">All Categories</h5>

    @forelse($categories as $category)

      <div class="d-flex justify-content-between align-items-center border-bottom py-2">

        <div>
          <strong>{{ $category->name }}</strong>

          @if(!$category->is_active)
            <span class="badge bg-danger ms-2">Hidden</span>
          @endif
        </div>

        <form method="POST" action="{{ route('admin.categories.toggle', $category->id) }}">
          @csrf
          <button class="btn btn-sm {{ $category->is_active ? 'btn-warning' : 'btn-success' }}">
            {{ $category->is_active ? 'Hide' : 'Show' }}
          </button>
        </form>

      </div>

    @empty
      <p class="text-muted text-center">No categories yet.</p>
    @endforelse

  </div>

</div>

</x-layout>