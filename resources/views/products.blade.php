<x-layout>

<section class="container py-5">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-5">

        <div>
            <h1 class="section-title mb-2">
                Explore Products
            </h1>

            <p class="section-subtitle">
                Discover premium electronics and accessories
            </p>
        </div>

    </div>

    <div class="row g-4">

        <!-- FILTER SIDEBAR -->
        <div class="col-lg-3">

            <div class="filter-card">

                <h4 class="filter-title">
                    Filters
                </h4>

                <form method="GET">

                    <!-- CATEGORY -->
                    <div class="mb-4">

                        <label class="form-label premium-label">
                            Category
                        </label>

                        <select name="category" class="form-select premium-input">

                            <option value="">All Categories</option>

                            @foreach($categories as $cat)

                                <option value="{{ $cat->id }}"
                                    {{ request('category') == $cat->id ? 'selected' : '' }}>

                                    {{ $cat->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- MIN PRICE -->
                    <div class="mb-4">

                        <label class="form-label premium-label">
                            Min Price $
                        </label>

                        <input
                            type="number"
                            name="min_price"
                            class="form-control premium-input"
                            value="{{ request('min_price') }}"
                            placeholder="0"
                        >

                    </div>

                    <!-- MAX PRICE -->
                    <div class="mb-4">

                        <label class="form-label premium-label">
                            Max Price $
                        </label>

                        <input
                            type="number"
                            name="max_price"
                            class="form-control premium-input"
                            value="{{ request('max_price') }}"
                            placeholder="9999"
                        >

                    </div>

                    <!-- BUTTONS -->
                    <button class="btn gradient-btn w-100 mb-3">
                        Apply Filters
                    </button>

                    <a href="{{ route('products.filter') }}"
                       class="btn premium-reset-btn w-100">

                        Reset Filters

                    </a>

                </form>

            </div>

        </div>

        <!-- PRODUCTS -->
        <div class="col-lg-9">

            <div class="row g-4">

                @forelse($products as $product)

                <div class="col-md-6 col-xl-4">

                    <div class="product-card h-100">

                        <!-- IMAGE -->
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

                        <!-- CONTENT -->

                        <div class="product-content d-flex flex-column">
                           


                            <small class="product-category">
                                {{ $product->category->name }}
                            </small>

                            <h5 class="product-title">
                                {{$product->name}}
                            </h5>

                            <p class="product-description">
                                {{ Str::limit($product->description, 90) }}
                            </p>

                            <div class="mt-auto">

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

                @empty

                <div class="col-12">

                    <div class="empty-products">

                        <h3>
                            No Products Found
                        </h3>

                        <p>
                            Try changing your filters.
                        </p>

                    </div>

                </div>

                @endforelse

            </div>

            <!-- PAGINATION -->
            <div class="d-flex justify-content-center mt-5">
                {{ $products->links() }}
            </div>

        </div>

    </div>

</section>

</x-layout>