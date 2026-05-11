<x-layout>

<section class="container py-5">

    <!-- TITLE -->
    <div class="text-center mb-5">

        <h1 class="section-title">
            Your Cart
        </h1>

        <p class="section-subtitle">
            Review your selected products
        </p>

    </div>

    <!-- ERROR -->
    @if(session('error'))

        <div class="alert alert-danger text-center mb-4">
            {{ session('error') }}
        </div>

    @endif

    @if(session('cart') && count(session('cart')) > 0)

    <div class="premium-cart-wrapper">

        @php $grandTotal = 0; @endphp

        @foreach(session('cart') as $id => $item)

        @php

    $finalPrice = isset($item['sale_percent'])
        ? $item['price'] -
          ($item['price'] * $item['sale_percent'] / 100)
        : $item['price'];

    $total = $finalPrice * $item['quantity'];

    $grandTotal += $total;

@endphp

        <!-- ITEM -->
        <div class="cart-item">

            <div class="row align-items-center g-4">

                <!-- IMAGE -->
                <div class="col-lg-2 col-md-3 col-4">

                    <div class="cart-image-wrapper">

                       @if(isset($item['sale_percent']) && $item['sale_percent'])

    <div class="sale-product-badge">

        -{{$item['sale_percent']}}%

    </div>

@endif

<img
    src="/assets/images/{{$item['image']}}"
    class="cart-image"
>

                    </div>

                </div>

                <!-- INFO -->
                <div class="col-lg-3 col-md-9 col-8">

                    <h4 class="cart-product-title">
                        {{$item['name']}}
                    </h4>

                    @if(isset($item['sale_percent']) && $item['sale_percent'])

    <div class="d-flex align-items-center gap-2 flex-wrap">

        <span class="old-price">

            ${{$item['price']}}

        </span>

        <span class="sale-price">

            ${{
                number_format($finalPrice, 2)
            }}

        </span>

    </div>

@else

    <p class="cart-price">

        ${{$item['price']}}

    </p>

@endif

                </div>

                <!-- QUANTITY -->
                <div class="col-lg-3">

                    <div class="quantity-controls">

                        <!-- DECREASE -->
                        <form action="{{ route('cart.decrease', $id) }}" method="POST">
                            @csrf

                            <button class="quantity-btn">
                                −
                            </button>
                        </form>

                        <span class="quantity-number">
                            {{$item['quantity']}}
                        </span>

                        <!-- INCREASE -->
                        <form action="{{ route('cart.increase', $id) }}" method="POST">
                            @csrf

                            <button class="quantity-btn">
                                +
                            </button>
                        </form>

                    </div>

                </div>

                <!-- TOTAL -->
                <div class="col-lg-2">

                    <div class="cart-total">
                        ${{$total}}
                    </div>

                </div>

                <!-- REMOVE -->
                <div class="col-lg-2 text-lg-end">

                    <form action="{{ route('cart.remove', $id) }}" method="POST">

                        @csrf

                        <button class="remove-cart-btn">
                            Remove
                        </button>

                    </form>

                </div>

            </div>

        </div>

        @endforeach

    </div>

    <!-- FOOTER -->
    <div class="cart-summary mt-5">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">

            <div>

                <p class="summary-label">
                    Grand Total
                </p>

                <h2 class="summary-price">
                    ${{$grandTotal}}
                </h2>

            </div>

            <!-- CHECKOUT -->
            <form action="{{ route('checkout') }}" method="POST">

                @csrf

                <button class="gradient-btn">
                    Proceed To Checkout
                </button>

            </form>

        </div>

    </div>

    @else

    <!-- EMPTY -->
    <div class="empty-cart-wrapper text-center">

        <div class="empty-cart-icon">
            🛒
        </div>

        <h2 class="mb-3">
            Your Cart Is Empty
        </h2>

        <p class="section-subtitle mb-4">
            Looks like you haven’t added anything yet.
        </p>

        <a href="{{ route('products.filter') }}"
           class="gradient-btn">

            Continue Shopping

        </a>

    </div>

    @endif

</section>

</x-layout>