<x-layout>

<section class="container py-5" style="max-width: 850px;">

    <!-- HEADER -->
    <div class="text-center mb-5">

        <h1 class="section-title">
            Edit Product
        </h1>

        <p class="section-subtitle">
            Update product details and inventory
        </p>

    </div>

    <!-- SUCCESS -->
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

    <!-- ERRORS -->
    @if($errors->any())

        <div class="alert alert-danger mb-4">

            <ul class="mb-0">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <!-- CARD -->
    <div class="carousel-admin-card">

        <form action="{{ route('admin.products.update', $product->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <!-- PRODUCT NAME -->
            <div class="mb-4">

                <label class="form-label premium-label">
                    Product Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ $product->name }}"
                    class="form-control premium-input"
                    required
                >

            </div>

            <!-- DESCRIPTION -->
            <div class="mb-4">

                <label class="form-label premium-label">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="4"
                    class="form-control premium-input"
                    required>{{ $product->description }}</textarea>

            </div>

            <!-- PRICE + STOCK -->
            <div class="row">

                <div class="col-md-6 mb-4">

                    <label class="form-label premium-label">
                        Price ($)
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="price"
                        value="{{ $product->price }}"
                        class="form-control premium-input"
                        required
                    >

                </div>

                <div class="col-md-6 mb-4">

                    <label class="form-label premium-label">
                        Stock
                    </label>

                    <input
                        type="number"
                        name="stock"
                        value="{{ $product->stock }}"
                        class="form-control premium-input"
                        required
                    >

                </div>
                <div class="col-md-6 mb-3">

    <label class="form-label">
        Sale Percentage
    </label>

    <input
        type="number"
        name="sale_percent"
        value="{{ $product->sale_percent }}"
        class="form-control"
        placeholder="Example: 20"
    >

</div>

<div class="mb-3">

    <div class="form-check">

        <input
            type="checkbox"
            name="best_seller"
            value="1"
            class="form-check-input"
            id="bestSeller"

            {{ $product->best_seller ? 'checked' : '' }}
        >

        <label class="form-check-label" for="bestSeller">

            Best Seller Product

        </label>

    </div>

</div>

            </div>

            <!-- CATEGORY -->
            <div class="mb-4">

                <label class="form-label premium-label">
                    Category
                </label>

                <select
                    name="category_id"
                    class="form-select premium-input"
                    required
                >

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>

                            {{ $category->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <!-- CURRENT IMAGE -->
            <div class="mb-4 text-center">

                <p class="premium-label mb-3">
                    Current Image
                </p>

                <div class="edit-product-image-wrapper">

                    <img
                        src="/assets/images/{{$product->image}}"
                        class="edit-product-image"
                    >

                </div>

            </div>

            <!-- CHANGE IMAGE -->
            <div class="mb-5">

                <label class="form-label premium-label">
                    Change Image
                </label>

                <input
                    type="file"
                    name="image"
                    class="form-control premium-input"
                >

            </div>

            <!-- BUTTON -->
            <button class="gradient-btn w-100">

                Update Product

            </button>

        </form>

    </div>

</section>

</x-layout>