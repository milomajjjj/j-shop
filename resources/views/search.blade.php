<x-layout>

<div class="container mt-5">

  <!-- Title -->
  <h3 class="fw-bold mb-4">
    Search results for:
    <span class="text-primary">"{{ $query }}"</span>
  </h3>

  @if($products->isEmpty())

    <!-- Empty state -->
    <div class="text-center mt-5">
      <h5 class="text-muted">No products found 😕</h5>
      <a href="{{ route('home') }}" class="btn btn-primary mt-3">
        Back to Shop
      </a>
    </div>

  @else

    <div class="row g-4">

      @foreach($products as $product)
      <div class="col-md-4 col-lg-3">

        <div class="card h-100 border-0 shadow-sm">

          <!-- Image -->
          <img src="/assets/images/{{$product->image}}"
               class="card-img-top"
               style="height: 200px; object-fit: cover;">

          <!-- Body -->
          <div class="card-body d-flex flex-column">

            <h6 class="fw-bold">{{$product->name}}</h6>

            <small class="text-muted mb-2">
              {{ $product->category->name }}
            </small>

            <p class="small text-muted">
              {{ \Illuminate\Support\Str::limit($product->description, 60) }}
            </p>

            <p class="fw-bold text-primary mt-auto">
              ${{$product->price}}
            </p>

            <a href="{{ route('product.show', $product->id) }}"
               class="btn btn-outline-primary w-100 mt-2">
               View Product
            </a>

          </div>

        </div>

      </div>
      @endforeach

    </div>

  @endif

</div>

</x-layout>