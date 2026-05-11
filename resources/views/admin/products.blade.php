<x-layout>

<section class="container py-5">

    <!-- HEADER -->
    <div class="text-center mb-5">

        <h1 class="admin-main-title">
            Products Management
        </h1>

        <p class="section-subtitle">
            Add, edit, and manage your store products
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

    <!-- ADD PRODUCT -->
    <div class="carousel-admin-card mb-5" style="max-width:850px; margin:auto;">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

            <div>

                <h3 class="carousel-admin-title mb-1">
                    Add New Product
                </h3>

                <p class="section-subtitle mb-0">
                    Create a new product for your store
                </p>

            </div>

        </div>

        <form action="{{ route('admin.products.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <!-- NAME -->
            <div class="mb-4">

                <label class="form-label premium-label">
                    Product Name
                </label>

                <input
                    type="text"
                    name="name"
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
                    required></textarea>

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
                        class="form-control premium-input"
                        required
                    >

                </div>
                <div class="col-md-6 mb-4">

    <label class="form-label premium-label">
        Sale Percentage
    </label>

    <input
        type="number"
        name="sale_percent"
        class="form-control premium-input"
        placeholder="Example: 20"
    >

</div>
<div class="mb-4">

    <div class="form-check">

        <input
            type="checkbox"
            name="best_seller"
            value="1"
            class="form-check-input"
            id="bestSeller"
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

                    <option value="">
                        Select Category
                    </option>

                    @foreach($categories as $category)

                        <option value="{{ $category->id }}">

                            {{ $category->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <!-- IMAGE -->
                        <div class="mb-5">

                <label class="form-label premium-label">
                    Product Image
                </label>

                <input
                    type="file"
                    name="image"
                    class="form-control premium-input"
                    required
                >

            </div>

            <!-- BUTTON -->
            <button class="gradient-btn w-100">

                Add Product

            </button>

        </form>

    </div>

    <!-- PRODUCTS TABLE -->
    <div class="carousel-admin-card">

        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

            <div>

                <h3 class="carousel-admin-title mb-1">
                    All Products
                </h3>

                <p class="section-subtitle mb-0">
                    Manage your current inventory
                </p>

            </div>

        </div>
        <!-- SEARCH -->
<form method="GET" action="{{ route('admin.search') }}" class="mb-4">

    <div class="d-flex gap-2">

        <input
            type="text"
            name="search"
            class="form-control premium-input"
            placeholder="Search product..."
            value="{{ request('search') }}"
        >

        <button class="gradient-btn px-4">

            Search

        </button>

    </div>

</form>

        <div class="table-responsive">

            <table class="table premium-orders-table align-middle">

                <thead>

                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($products as $product)

                    <tr>

                        <!-- IMAGE -->
                        <td>

                            <img
                                src="/assets/images/{{$product->image}}"
                                class="admin-product-image"
                            >

                        </td>

                        <!-- NAME -->
                        <td class="fw-bold">

                            {{ $product->name }}

                        </td>

                        <!-- CATEGORY -->
                        <td>

                            {{ $product->category->name ?? '-' }}

                        </td>

                        <!-- PRICE -->
                        <td class="fw-bold">

                            ${{ $product->price }}

                        </td>

                        <!-- STOCK -->
                        <td>

                            @if($product->stock == 0)

                                <span class="out-stock-text">
                                    Out
                                </span>

                            @else

                                {{ $product->stock }}

                            @endif

                        </td>

                        <!-- STATUS -->
                        <td>

                            @if($product->is_active)

                                <span class="premium-status-badge delivered-status">
                                    Active
                                </span>

                            @else

                                <span class="premium-status-badge cancelled-status">
                                    Hidden
                                </span>

                            @endif

                        </td>

                        <!-- ACTIONS -->
                        <td>

                            <div class="d-flex gap-2 flex-wrap">

                                <!-- EDIT -->
                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                   class="carousel-edit-btn text-center">

                                    Edit

                                </a>

                                <!-- TOGGLE -->
                                <form action="{{ route('admin.products.toggle', $product->id) }}"
                                      method="POST">

                                    @csrf

                                    <button class="
                                        {{ $product->is_active
                                            ? 'product-hide-btn'
                                            : 'product-show-btn'
                                        }}
                                    ">

                                        {{ $product->is_active ? 'Hide' : 'Show' }}

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7" class="text-center text-muted py-5">

                            No products yet.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

         

        </div>
   <div class="d-flex justify-content-center mt-5">
        {{ $products->links() }}
    </div>
    </div>

</section>

</x-layout>