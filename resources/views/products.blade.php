<x-layout>

<div class="container mt-4">

  <h2 class="mb-4 titles">All Products</h2>

  <div class="row">

    <!-- FILTERS -->
    <div class="col-md-3">

      <div class="card p-3 shadow-sm">

        <h5>Filters</h5>

        <form method="GET">

          <!-- Category -->
          <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-select">
              <option value="">All</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                  {{ request('category') == $cat->id ? 'selected' : '' }}>
                  {{ $cat->name }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Min Price -->
          <div class="mb-3">
            <label class="form-label">Min Price$</label>
            <input type="number" name="min_price" class="form-control"
                   value="{{ request('min_price') }}">
          </div>

          <!-- Max Price -->
          <div class="mb-3">
            <label class="form-label">Max Price$</label>
            <input type="number" name="max_price" class="form-control"
                   value="{{ request('max_price') }}">
          </div>

          <button class="btn btn-primary w-100">Apply</button>
          <a href="{{ route('products.filter') }}" class="btn btn-secondary w-100 mt-2">
  Reset
</a>

        </form>

      </div>

    </div>

    <!-- PRODUCTS -->
    <div class="col-md-9">

      <div class="row">

        @forelse($products as $product)

        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">

            <img src="/assets/images/{{$product->image}}"
                 class="card-img-top"
                 style="height: 200px; object-fit: cover;">

            <div class="card-body d-flex flex-column">

              <h5>{{$product->name}}</h5>

              <p class="text-muted">
                {{ $product->category->name }}
              </p>

              <p>{{$product->description}}</p>

              <p class="fw-bold mt-auto">${{$product->price}}</p>

              <a href="{{ route('product.show', $product->id) }}"
                 class="btn btn-outline-primary mt-2">
                 View Product
              </a>

            </div>

          </div>
        </div>

        @empty
          <p>No products found.</p>
        @endforelse

      </div>
<div class="d-flex justify-content-center mt-4">
  {{ $products->links() }}
</div>
    </div>

  </div>

</div>

</x-layout>