<x-layout>

<section class="container py-5" style="max-width: 1100px;">

    <!-- HEADER -->
    <div class="text-center mb-5">

        <h1 class="admin-main-title">
            Categories Management
        </h1>

        <p class="section-subtitle">
            Organize your products visually
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

    <div class="row g-5">

        <!-- ADD CATEGORY -->
        <div class="col-lg-4">

            <div class="carousel-admin-card">

                <h3 class="carousel-admin-title">
                    Add Category
                </h3>

                <form method="POST"
                      action="{{ route('admin.categories.store') }}"
                      enctype="multipart/form-data">

                    @csrf

                    <!-- NAME -->
                    <div class="mb-4">

                        <label class="form-label premium-label">
                            Category Name
                        </label>

                        <input
                            type="text"
                            name="name"
                            class="form-control premium-input"
                            placeholder="Enter category name"
                            required
                        >

                    </div>

                    <!-- IMAGE -->
                    <div class="mb-5">

                        <label class="form-label premium-label">
                            Category Image
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

                        Add Category

                    </button>

                </form>

            </div>

        </div>

        <!-- ALL CATEGORIES -->
        <div class="col-lg-8">

            <div class="carousel-admin-card">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h3 class="carousel-admin-title mb-1">
                            All Categories
                        </h3>

                        <p class="section-subtitle mb-0">
                            Manage your product categories
                        </p>

                    </div>

                </div>

                <div class="row g-4">

                    @forelse($categories as $category)

                    <div class="col-md-6">

                        <div class="category-admin-card h-100">

                            <!-- IMAGE -->
                            <div class="category-admin-image-wrapper">

                                <img
                                    src="/assets/images/{{$category->image}}"
                                    class="category-admin-image"
                                >

                            </div>

                            <!-- CONTENT -->
                            <div class="category-admin-content">

                                <div class="d-flex justify-content-between align-items-center mb-3">

                                    <h5 class="category-admin-title">

                                        {{ $category->name }}

                                    </h5>

                                    @if(!$category->is_active)

                                        <span class="premium-status-badge cancelled-status">
                                            Hidden
                                        </span>

                                    @endif

                                </div>

                                <!-- ACTIONS -->
                                <div class="d-flex gap-3 mt-4">

                                    <!-- TOGGLE -->
                                    <form method="POST"
                                          action="{{ route('admin.categories.toggle', $category->id) }}"
                                          class="w-100">

                                        @csrf

                                        <button class="
                                            w-100
                                            {{ $category->is_active
                                                ? 'product-hide-btn'
                                                : 'product-show-btn'
                                            }}
                                        ">

                                            {{ $category->is_active ? 'Hide' : 'Show' }}

                                        </button>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                    @empty

                    <div class="col-12">

                        <div class="empty-products text-center">

                            <h3>
                                No Categories Yet
                            </h3>

                            <p>
                                Create your first category.
                            </p>

                        </div>

                    </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</section>

</x-layout>