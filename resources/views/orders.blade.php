<x-layout>

<div class="container mt-5">

  @if(session('success'))
<div class="container mt-3">
  <div class="alert alert-success text-center fw-bold">
    {{ session('success') }}
  </div>
</div>
@endif

  <!-- Title -->
  <h2 class="fw-bold text-center mb-4">My Orders</h2>

  @if($orders->isEmpty())

    <!-- Empty state -->
    <div class="text-center mt-5">
      <h5 class="text-muted">You have no orders yet 📦</h5>
      <a href="{{ route('home') }}" class="btn btn-primary mt-3">
        Start Shopping
      </a>
    </div>

  @else

    @foreach($orders as $order)

    <div class="card shadow-sm mb-4 border-0">

      <!-- Header -->
      <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap">

        <div >
          <strong class="titles">Order #{{ $order->id }}</strong>

          <span class="ms-3 text-muted">
            {{ $order->created_at->format('Y-m-d') }}
          </span>
        </div>

        <!-- Status -->
        <span class="badge 
          @if($order->status == 'pending') bg-warning text-dark
          @elseif($order->status == 'shipped') bg-info text-dark
          @elseif($order->status == 'delivered') bg-success
          @elseif($order->status == 'cancelled') bg-danger
          @endif
        ">
          {{ ucfirst($order->status) }}
        </span>

      </div>

      <!-- Body -->
      <div class="card-body">

        <div class="table-responsive">
          <table class="table table-hover align-middle">

            <thead class="table-light">
              <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
              </tr>
            </thead>

            <tbody>
              @foreach($order->items as $item)
              <tr>
                <td class="fw-bold">{{ $item->product->name }}</td>
                <td>${{ $item->price }}</td>
                <td>{{ $item->quantity }}</td>
                <td class="fw-bold">
                  ${{ $item->price * $item->quantity }}
                </td>
              </tr>
              @endforeach
            </tbody>

          </table>
        </div>

        <!-- Total -->
        <div class="text-end">
          <h5 class="fw-bold text-primary">
            Total: ${{ $order->total }}
          </h5>
        </div>

      </div>

    </div>

    @endforeach

  @endif

</div>

</x-layout>