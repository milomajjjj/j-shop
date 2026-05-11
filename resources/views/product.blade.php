<x-layout>

<section class="container py-5">

    <!-- ALERTS -->
    @if(session('success'))

<div class="container mt-4">

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

    @if(session('error'))
        <div class="alert alert-danger text-center mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- PRODUCT -->
    <div class="premium-product-wrapper">

        <div class="row align-items-center g-5">

            <!-- IMAGE -->
            <div class="col-lg-6">

                <div class="premium-product-image-card">

    <!-- BEST SELLER -->
    @if($product->best_seller)

        <div class="best-seller-badge">

            🔥 BEST SELLER

        </div>

    @endif

    <!-- SALE -->
    @if($product->sale_percent)

        <div class="sale-product-badge">

            -{{$product->sale_percent}}%

        </div>

    @endif

    <!-- IMAGE -->
    <img
        src="/assets/images/{{$product->image}}"
        class="premium-product-image"
    >

</div>
            </div>

            <!-- INFO -->
            <div class="col-lg-6">

                <span class="single-product-category">
                    {{ $product->category->name ?? 'No Category' }}
                </span>

                <h1 class="single-product-title">
                    {{$product->name}}
                </h1>

               @if($product->sale_percent)

    <div class="d-flex align-items-center gap-3 flex-wrap mb-4">

        <!-- OLD PRICE -->
        <span class="old-price">

            ${{ $product->price }}

        </span>

        <!-- NEW PRICE -->
        <span class="sale-price">

            ${{
                number_format(
                    $product->price -
                    ($product->price * $product->sale_percent / 100),
                    2
                )
            }}

        </span>

    </div>

@else

    <div class="single-product-price">

        ${{$product->price}}

    </div>

@endif

                <!-- STOCK -->
                <div class="mb-4">

                    @if($product->stock == 0)

                        <span class="stock-badge danger-badge">
                            Out Of Stock
                        </span>

                    @else

                        <span class="stock-badge success-badge">
                            {{$product->stock}} Available
                        </span>

                    @endif

                </div>

                <!-- DESCRIPTION -->
                <p class="single-product-description">
                    {{$product->description}}
                </p>

                <!-- FEATURES -->
                <div class="product-features">

                    <div class="feature-item">
                        ⚡ Premium Performance
                    </div>

                    <div class="feature-item">
                        🚚 Fast Delivery
                    </div>

                    <div class="feature-item">
                        🔒 Secure Checkout
                    </div>

                </div>

                <!-- BUTTON -->
                @if($product->stock == 0)

                    <button class="btn disabled-product-btn w-100 mt-4" disabled>
                        Out Of Stock
                    </button>

                @else

                    <form action="{{ route('cart.add', $product->id) }}" method="POST">

                        @csrf

                        <button class="gradient-btn w-100 mt-4">
                            Add To Cart
                        </button>

                    </form>

                @endif

            </div>

        </div>

    </div>

    <!-- RECOMMENDED -->
    <section class="mt-5 pt-5">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>

                <h2 class="section-title mb-2">
                    Recommended Products
                </h2>

                <p class="section-subtitle">
                    You may also like these products
                </p>

            </div>

        </div>

        <div class="row g-4">

            @forelse($recommended as $item)

            <div class="col-md-6 col-xl-3">

                <div class="product-card h-100">

                    <!-- IMAGE -->
                    <div class="product-image-wrapper">
<!-- BEST SELLER -->
@if($item->best_seller)

    <div class="best-seller-badge">

        🔥 BEST SELLER

    </div>

@endif

<!-- SALE -->
@if($item->sale_percent)

    <div class="sale-product-badge">

        -{{$item->sale_percent}}%

    </div>

@endif

<img
    src="/assets/images/{{$item->image}}"
    class="product-image"
>

                    </div>

                    <!-- CONTENT -->
                    <div class="product-content d-flex flex-column">

                        <small class="product-category">
                            {{ $item->category->name }}
                        </small>

                        <h5 class="product-title">
                            {{$item->name}}
                        </h5>

                        <div class="mt-auto">

                            @if($item->sale_percent)

    <div class="d-flex align-items-center gap-2 flex-wrap mb-3">

        <span class="old-price">

            ${{ $item->price }}

        </span>

        <span class="sale-price">

            ${{
                number_format(
                    $item->price -
                    ($item->price * $item->sale_percent / 100),
                    2
                )
            }}

        </span>

    </div>

@else

    <p class="product-price">

        ${{$item->price}}

    </p>

@endif

                            <a href="{{ route('product.show', $item->id) }}"
                               class="btn product-btn w-100">

                                View Product

                            </a>

                        </div>

                    </div>

                </div>

            </div>

            @empty

            <div class="col-12">

                <div class="empty-products">

                    <h3>No Recommendations</h3>

                    <p>
                        More products coming soon.
                    </p>

                </div>

            </div>

            @endforelse

        </div>

    </section>

</section>

</x-layout>