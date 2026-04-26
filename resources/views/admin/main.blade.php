<x-layout>

<div class="container mt-5">

  <!-- Title -->
  <h2 class="text-center fw-bold mb-5">Admin Dashboard</h2>

  <!-- Dashboard Cards -->
  <div class="row g-4">

    <!-- Users -->
    <div class="col-md-6 col-lg-4">
      <a href="{{ route('admin.users') }}" class="text-decoration-none">
        <div class="card shadow-sm border-0 h-100 text-center p-4">
          <h5 class="fw-bold">Users</h5>
          <p class="text-muted small">Manage all registered users</p>
        </div>
      </a>
    </div>

    <!-- Carousel -->
    <div class="col-md-6 col-lg-4">
      <a href="{{ route('admin.carousel') }}" class="text-decoration-none">
        <div class="card shadow-sm border-0 h-100 text-center p-4">
          <h5 class="fw-bold">Carousel</h5>
          <p class="text-muted small">Manage homepage slides</p>
        </div>
      </a>
    </div>

    <!-- Products -->
    <div class="col-md-6 col-lg-4">
      <a href="{{ route('admin.products') }}" class="text-decoration-none">
        <div class="card shadow-sm border-0 h-100 text-center p-4">
          <h5 class="fw-bold">Products</h5>
          <p class="text-muted small">Add, edit, and manage products</p>
        </div>
      </a>
    </div>

    <!-- Categories -->
    <div class="col-md-6 col-lg-4">
      <a href="{{ route('admin.categories') }}" class="text-decoration-none">
        <div class="card shadow-sm border-0 h-100 text-center p-4">
          <h5 class="fw-bold">Categories</h5>
          <p class="text-muted small">Organize your products</p>
        </div>
      </a>
    </div>

    <!-- Orders -->
    <div class="col-md-6 col-lg-4">
      <a href="{{ route('admin.orders') }}" class="text-decoration-none">
        <div class="card shadow-sm border-0 h-100 text-center p-4">
          <h5 class="fw-bold">Orders</h5>
          <p class="text-muted small">Track and manage orders</p>
        </div>
      </a>
    </div>

  </div>

</div>

</x-layout>