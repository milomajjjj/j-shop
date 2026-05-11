<x-layout>

<section class="container py-5">

    <!-- HEADER -->
    <div class="text-center mb-5">

        <h1 class="admin-main-title">
            Orders Management
        </h1>

        <p class="section-subtitle">
            Track and manage customer purchases
        </p>

    </div>

    @forelse($orders as $order)

    <!-- ORDER CARD -->
    <div class="premium-order-card mb-5">

        <!-- TOP -->
        <div class="premium-order-header">

            <div class="d-flex flex-wrap gap-4 align-items-center">

                <div>

                    <p class="order-label">
                        ORDER ID
                    </p>

                    <h4 class="order-value">
                        #{{ $order->id }}
                    </h4>

                </div>

                <div>

                    <p class="order-label">
                        DATE
                    </p>

                    <h4 class="order-value">
                        {{ $order->created_at->format('Y-m-d') }}
                    </h4>

                </div>

                <div>

                    <p class="order-label">
                        CUSTOMER
                    </p>

                    <h4 class="order-value">
                        {{ $order->user->name }}
                    </h4>

                </div>

            </div>

            <!-- STATUS -->
            <div class="d-flex align-items-center gap-3 flex-wrap">

                <!-- BADGE -->
                <span class="
                    premium-status-badge

                    @if($order->status == 'pending')
                        pending-status
                    @elseif($order->status == 'shipped')
                        shipped-status
                    @elseif($order->status == 'delivered')
                        delivered-status
                    @elseif($order->status == 'cancelled')
                        cancelled-status
                    @endif
                ">

                    {{ ucfirst($order->status) }}

                </span>

                <!-- SELECT -->
                <form action="{{ route('admin.orders.status', $order->id) }}"
                      method="POST">

                    @csrf

                    <select
                        name="status"
                        onchange="if(this.value !== '{{ $order->status }}') this.form.submit()"
                        class="premium-order-select"
                    >

                        <option value="pending"
                            {{ $order->status == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="shipped"
                            {{ $order->status == 'shipped' ? 'selected' : '' }}>
                            Shipped
                        </option>

                        <option value="delivered"
                            {{ $order->status == 'delivered' ? 'selected' : '' }}>
                            Delivered
                        </option>

                    </select>

                </form>

            </div>

        </div>

        <!-- TABLE -->
        <div class="table-responsive">

            <table class="table premium-orders-table align-middle">

                <thead>

                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($order->items as $item)

                    <tr>

                        <td class="fw-bold">
                            {{ $item->product->name }}
                        </td>

                        <td>
                            ${{ $item->price }}
                        </td>

                        <td>
                            {{ $item->quantity }}
                        </td>

                        <td class="fw-bold">
                            ${{ $item->price * $item->quantity }}
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <!-- TOTAL -->
        <div class="premium-order-total text-end">

            <span class="total-label">
                Order Total
            </span>

            <h2 class="total-price">
                ${{ $order->total }}
            </h2>

        </div>

    </div>

    @empty

    <div class="empty-products text-center">

        <h3>
            No Orders Yet
        </h3>

        <p>
            Orders will appear here once customers purchase.
        </p>

    </div>

    @endforelse

</section>

</x-layout>