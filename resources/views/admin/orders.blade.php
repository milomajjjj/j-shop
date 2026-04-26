<x-layout>

<div class="container mt-5">

  <!-- Title -->
  <h2 class="mb-4 fw-bold text-center">Orders Management</h2>

  @forelse($orders as $order)

  <div class="card mb-4 shadow-sm border-0">

    <!-- Header -->
    <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap">

      <div class="mb-2 mb-md-0">
        <strong>Order #{{ $order->id }}</strong>

        <span class="ms-3 text-muted">
          {{ $order->created_at->format('Y-m-d') }}
        </span>

        <span class="ms-3">
          <strong>User:</strong> {{ $order->user->name }}
        </span>
      </div>

      <!-- Status -->
      <div class="d-flex align-items-center gap-2">

        <span class="badge 
          @if($order->status == 'pending') bg-warning text-dark
          @elseif($order->status == 'shipped') bg-info text-dark
          @elseif($order->status == 'delivered') bg-success
          @elseif($order->status == 'cancelled') bg-danger
          @endif
        ">
          {{ ucfirst($order->status) }}
        </span>

        <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
          @csrf
          <select name="status"
                  onchange="if(this.value !== '{{ $order->status }}') this.form.submit()"
                  class="form-select form-select-sm">
            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
          </select>
        </form>

      </div>

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
              <td class="fw-bold">${{ $item->price * $item->quantity }}</td>
            </tr>
            @endforeach
          </tbody>

        </table>
      </div>

      <!-- Order Total -->
      <div class="text-end">
        <h5 class="fw-bold text-primary">
          Total: ${{ $order->total }}
        </h5>
      </div>

    </div>

  </div>

  @empty
    <div class="text-center text-muted">
      No orders yet.
    </div>
  @endforelse

</div>

</x-layout>