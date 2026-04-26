<x-layout>

<div class="container mt-5">

  <h2 class="fw-bold mb-4 text-center">Your Cart</h2>

  @if(session('error'))
    <div class="alert alert-danger text-center">
      {{ session('error') }}
    </div>
  @endif

  @if(session('cart') && count(session('cart')) > 0)

  <div class="card shadow-sm p-3">

    <div class="table-responsive">
      <table class="table table-hover align-middle">

        <thead class="table-light">
          <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th></th>
          </tr>
        </thead>

        <tbody>

          @php $grandTotal = 0; @endphp

          @foreach(session('cart') as $id => $item)
          @php
            $total = $item['price'] * $item['quantity'];
            $grandTotal += $total;
          @endphp

          <tr>

            <!-- Product -->
            <td class="d-flex align-items-center gap-2">
              <img src="/assets/images/{{$item['image']}}" 
                   style="width:60px; height:60px; object-fit:cover;" 
                   class="rounded">
              <span class="fw-bold">{{$item['name']}}</span>
            </td>

            <!-- Price -->
            <td>${{$item['price']}}</td>

            <!-- Quantity -->
            <td>
              <div class="d-flex align-items-center gap-2">

                <form action="{{ route('cart.decrease', $id) }}" method="POST">
                  @csrf
                  <button class="btn btn-sm btn-outline-secondary">-</button>
                </form>

                <span class="fw-bold">{{$item['quantity']}}</span>

                <form action="{{ route('cart.increase', $id) }}" method="POST">
                  @csrf
                  <button class="btn btn-sm btn-outline-secondary">+</button>
                </form>

              </div>
            </td>

            <!-- Total -->
            <td class="fw-bold">${{$total}}</td>

            <!-- Remove -->
            <td>
              <form action="{{ route('cart.remove', $id) }}" method="POST">
                @csrf
                <button class="btn btn-sm btn-danger">
                  Remove
                </button>
              </form>
            </td>

          </tr>
          @endforeach

        </tbody>

      </table>
    </div>

  </div>

  <!-- Total + Checkout -->
  <div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">

    <h4 class="fw-bold text-primary">
      Total: ${{$grandTotal}}
    </h4>

    <form action="{{ route('checkout') }}" method="POST">
      @csrf
      <button class="btn btn-success px-4">
        Proceed to Checkout
      </button>
    </form>

  </div>

  @else

  <!-- Empty Cart -->
  <div class="text-center mt-5">
    <h4 class="titles">Your cart is empty 🛒</h4>
    <a href="{{ route('home') }}" class="btn btn-primary mt-3">
      Continue Shopping
    </a>
  </div>

  @endif

</div>

</x-layout>