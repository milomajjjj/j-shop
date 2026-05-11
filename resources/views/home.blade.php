<x-layout>
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

<!-- HERO SECTION -->
<section class="hero-section">

    <div class="container">

        <div class="hero-card">

            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

                <div class="carousel-inner">

                    @foreach($carousel as $image)

                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">

                        <img src="/assets/images/{{$image->pic}}" class="d-block w-100 hero-image">

                        <div class="hero-overlay">

                            <div class="hero-content">

                                <span class="hero-badge">
                                    {{ $image->title }}
                                </span>

                                <h4>
                                  {{ $image->description }}
                                </h4>

                                

                                <a href="{{ route('products.filter') }}" class="btn gradient-btn mt-3">
                                    Shop Now
                                </a>

                            </div>

                        </div>

                    </div>

                    @endforeach

                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>

            </div>

        </div>

    </div>
</section>


<!-- CATEGORY SECTION -->
<div class="container mt-5">

    <h3 class="section-title mb-4">
        Shop by Category
    </h3>

    <div class="row g-4">

        @foreach($categories as $category)

        <div class="col-6 col-md-4 col-lg-3">

            <a href="{{ route('products.filter', ['category' => $category->id]) }}"
               class="text-decoration-none">

                <div class="premium-category-card">

                    <!-- IMAGE -->
                    <div class="premium-category-image-wrapper">

                        <img
                            src="/assets/images/{{$category->image}}"
                            class="premium-category-image"
                        >

                    </div>

                    <!-- CONTENT -->
                    <div class="premium-category-content">

                        <h5 class="premium-category-title">
                            {{ $category->name }}
                        </h5>

                    </div>

                </div>

            </a>

        </div>

        @endforeach

    </div>

</div>

<!-- PRODUCTS -->
<section class="container mt-5">

    <div class="section-header d-flex justify-content-between align-items-center flex-wrap gap-3">

        <div>
            <h2 class="section-title">Featured Products</h2>
            <p class="section-subtitle">Best trending electronics</p>
        </div>

        <a href="{{ route('products.filter') }}" class="btn premium-btn">
            View All
        </a>

    </div>

    <div class="row g-4 mt-2">

        @foreach($products as $product)

        <div class="col-md-4 col-lg-3">

            <div class="product-card h-100">

                <div class="product-image-wrapper">
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
    class="product-image"
>

<!-- STOCK -->
@if($product->stock > 0)

    <span class="stock-badge success-badge">

        In Stock

    </span>

@else

    <span class="stock-badge danger-badge">

        Out Of Stock

    </span>

@endif

                </div>

                <div class="product-content">

                    <small class="product-category">
                        {{ $product->category->name ?? 'No Category' }}
                    </small>

                    <h5 class="product-title">
                        {{$product->name}}
                    </h5>

                    <div class="product-bottom">

                        @if($product->sale_percent)

    <div class="d-flex align-items-center gap-2 flex-wrap mb-3">

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

    <p class="product-price">

        ${{$product->price}}

    </p>

@endif

                        <a href="{{ route('product.show', $product->id) }}"
                           class="btn product-btn w-100">
                            View Product
                        </a>

                    </div>

                </div>

            </div>

             </div>

        @endforeach

    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $products->links() }}
    </div>

</section>

<!-- BANNER -->
<section class="container mt-5">

    <div class="premium-banner">

        <div class="row align-items-center">

            <div class="col-lg-7">

                <span class="banner-mini-title">
                    PREMIUM TECH STORE
                </span>

                <h2>
                    Upgrade Your Setup <br>
                    With Modern Electronics
                </h2>

                <p>
                    Discover high-performance devices and accessories built for the future.
                </p>

                <a href="{{ route('products.filter') }}" class="btn gradient-btn mt-3">
                    Explore Products
                </a>

            </div>

        </div>

    </div>

</section>
<!-- WHY US -->
<section class="container mt-5 mb-5">

    <div class="row g-4">

        <div class="col-md-4">
            <div class="why-card text-center">
                <div class="why-icon">🚚</div>
                <h4>Fast Delivery</h4>
                <p>Fast and reliable shipping on all orders.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="why-card text-center">
                <div class="why-icon">💳</div>
                <h4>Secure Payment</h4>
                <p>Encrypted checkout for maximum safety.</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="why-card text-center">
                <div class="why-icon">🎧</div>
                <h4>24/7 Support</h4>
                <p>Our support team is always here for you.</p>
            </div>
        </div>

    </div>

</section>

</x-layout>