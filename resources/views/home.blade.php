<x-layout>

<!-- ✅ Success Message -->
@if(session('success'))
<div class="container mt-3">
  <div class="alert alert-success text-center fw-bold">
    {{ session('success') }}
  </div>
</div>
@endif
<!-- CAROUSEL SECTION -->


<div class="container mt-4">
  <div id="carouselExampleCaptions"
       class="carousel slide rounded shadow overflow-hidden"
       data-bs-ride="carousel">

    <div class="carousel-inner">
      @foreach($carousel as $image)
      <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
        <img src="/assets/images/{{$image->pic}}"
             class="d-block w-100"
             style="height: 420px; object-fit: cover;">

    
       
      </div>
      @endforeach
    </div>

    <button class="carousel-control-prev" type="button"
            data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>

    <button class="carousel-control-next" type="button"
            data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>

  </div>
</div>

<!-- CATEGORY SECTION -->
<div class="container mt-5">
  <h4 class="fw-bold mb-3 titles">Shop by Category</h4>

  <div class="row g-3">
    @foreach($categories as $category)
    <div class="col-6 col-md-3">
      <a href="{{ route('products.filter', ['category' => $category->id]) }}"
         class="text-decoration-none">

        <div class="card text-center shadow-sm p-3 h-100 hover-card">
          <h6 class="fw-bold">{{ $category->name }}</h6>
        </div>

      </a>
    </div>
    @endforeach
  </div>
</div>

<!-- 🔥 FEATURED PRODUCTS -->
<div class="container mt-5">

  <h3 class="mb-4 fw-bold titles">🔥 Featured Products</h3>

  <div class="row g-4">

    @foreach($products as $product)
    <div class="col-md-4 col-lg-3">

      <div class="card h-100 border-0 shadow-sm hover-card">

        <!-- Image -->
        <img src="/assets/images/{{$product->image}}"
             class="card-img-top"
             style="height: 200px; object-fit: cover;">

        <!-- Body -->
        <div class="card-body d-flex flex-column">

          <h6 class="fw-bold">{{$product->name}}</h6>

          <small class="text-muted mb-2">
            {{ $product->category->name ?? 'No Category' }}
          </small>

          <p class="fw-bold fs-5 text-dark price-text">
            ${{$product->price}}
          </p>

          <!-- Stock badge -->
          @if($product->stock > 0)
            <span class="badge bg-success mb-2">In Stock</span>
          @else
            <span class="badge bg-danger mb-2">Out of Stock</span>
          @endif

          <a href="{{ route('product.show', $product->id) }}"
             class="btn btn-outline-primary mt-auto w-100">
             View Product
          </a>

        </div>
      </div>

    </div>
    @endforeach

  </div>

  <!-- Pagination -->
  <div class="d-flex justify-content-center mt-4">
    {{ $products->links() }}
  </div>

</div>

<!-- 🔥 PROMO BANNER -->
<div class="container mt-5">
  <div class="bg-dark text-white text-center p-5 rounded shadow">
    <h3 class="fw-bold">Upgrade Your Tech Today</h3>
    <p>Best electronics at unbeatable prices</p>
    <a href="{{ route('products.filter') }}" class="btn btn-light">
      Browse Products
    </a>
  </div>
</div>

<!-- 🔥 WHY US -->
<div class="container mt-5 text-center">
  <div class="row">

    <div class="col-md-4 titles">
      <h5>🚚 Fast Delivery</h5>
      <p class="titles">2–5 days shipping</p>
    </div>

    <div class="col-md-4 titles">
      <h5>💳 Secure Payment</h5>
      <p class="titles">100% safe checkout</p>
    </div>

    <div class="col-md-4 titles">
      <h5>📞 24/7 Support</h5>
      <p class="titles">We’re here anytime</p>
    </div>

  </div>
</div>

</x-layout>