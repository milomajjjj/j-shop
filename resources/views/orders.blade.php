<x-layout>

<section class="container py-5">

    <!-- SUCCESS -->
    @if(session('success'))

    <div class="container mb-4">

        <div class="premium-alert-success">

            <span class="premium-alert-icon">
                ✓
            </span>

            <span>
                {{ session('success') }}
            </span>

        </div>

    </div>

    @endif

    <!-- HEADER -->
    <div class="text-center mb-5">

        <h1 class="admin-main-title">
            My Orders
        </h1>

        <p class="section-subtitle">
            Track all your purchases
        </p>

    </div>

    @if($orders->isEmpty())

    <!-- EMPTY -->
    <div class="empty-orders-wrapper text-center">

        <div class="empty-orders-icon">
            📦
        </div>

        <h2 class="mb-3">
            No Orders Yet
        </h2>

        <p class="section-subtitle mb-4">
            Start shopping to see your orders here.
        </p>

        <a href="{{ route('products.filter') }}"
           class="gradient-btn">

            Start Shopping

        </a>

    </div>

    @else

    @foreach($orders as $order)

    <!-- ORDER CARD -->
    <div class="premium-order-card mb-5">

        <!-- HEADER -->
        <div class="premium-order-header">

            <div class="d-flex align-items-center gap-4 flex-wrap">

                <div>

                    <p class="order-label">
                        ORDER
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

            </div>

            <!-- STATUS -->
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

    @endforeach

    @endif

</section>

</x-layout>