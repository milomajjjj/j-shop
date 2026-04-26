<x-layout>

    
<div class="container mt-5">

  <div class="row g-5 align-items-center">

    @if(session('success'))
    <div class="alert alert-success text-center">
      {{ session('success') }}
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger text-center">
      {{ session('error') }}
    </div>
  @endif

    <!-- Image -->
    <div class="col-md-6 text-center">
      <img src="/assets/images/{{$product->image}}" 
           class="img-fluid rounded shadow-sm"
           style="max-height: 400px; object-fit: cover;">
    </div>

    <!-- Info -->
    <div class="col-md-6">

      <h2 class="fw-bold mb-2">{{$product->name}}</h2>

      <p class="text-muted mb-3">
        {{ $product->category->name ?? 'No Category' }}
      </p>

      <h3 class="text-primary fw-bold mb-3">
        ${{$product->price}}
      </h3>

      <!-- Stock -->
      <p class="mb-3">
        @if($product->stock == 0)
          <span class="badge bg-danger">Out of Stock</span>
        @else
          <span class="badge bg-success">
            {{$product->stock}} available
          </span>
        @endif
      </p>

      <!-- Description -->
      <p class="text-muted">
        {{$product->description}}
      </p>

      <!-- Button -->
      @if($product->stock == 0)
        <button class="btn btn-secondary w-100 mt-3" disabled>
          Out of Stock
        </button>
      @else
        <form action="{{ route('cart.add', $product->id) }}" method="POST">
          @csrf
          <button class="btn btn-primary w-100 mt-3">
            Add to Cart
          </button>
        </form>
      @endif

    </div>

  </div>

  <!-- Divider -->
  <hr class="my-5">

  <!-- Recommended -->
  <h4 class="fw-bold mb-4">Recommended for you</h4>

  <div class="row g-4">

    @forelse($recommended as $item)
    <div class="col-md-3 col-sm-6">

      <div class="card h-100 border-0 shadow-sm">

        <img src="/assets/images/{{$item->image}}" 
             class="card-img-top"
             style="height: 160px; object-fit: cover;">

        <div class="card-body d-flex flex-column">

          <h6 class="fw-bold">{{$item->name}}</h6>

          <small class="text-muted mb-2">
            {{ $item->category->name }}
          </small>

          <p class="fw-bold text-primary mt-auto">
            ${{$item->price}}
          </p>

          <a href="{{ route('product.show', $item->id) }}" 
             class="btn btn-sm btn-outline-primary w-100 mt-2">
             View Product
          </a>

        </div>

      </div>

    </div>
    @empty
      <p class="text-muted">No recommendations available.</p>
    @endforelse

  </div>

</div>

</x-layout>