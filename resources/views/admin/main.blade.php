<x-layout>

<section class="container py-5">

    <!-- HEADER -->
    <div class="text-center mb-5">

        <h1 class="admin-main-title">
            Admin Dashboard
        </h1>

        <p class="section-subtitle">
            Manage your ecommerce platform
        </p>

    </div>

    <!-- DASHBOARD GRID -->
    <div class="row g-4">

        <!-- USERS -->
        <div class="col-md-6 col-xl-4">

            <a href="{{ route('admin.users') }}"
               class="text-decoration-none">

                <div class="admin-dashboard-card users-card">

                    <div class="admin-card-icon">
                        👥
                    </div>

                    <h3 class="admin-card-title">
                        Users
                    </h3>

                    <p class="admin-card-description">
                        Manage all registered users
                    </p>

                </div>

            </a>

        </div>

        <!-- CAROUSEL -->
        <div class="col-md-6 col-xl-4">

            <a href="{{ route('admin.carousel') }}"
               class="text-decoration-none">

                <div class="admin-dashboard-card carousel-card">

                    <div class="admin-card-icon">
                        🎞️
                    </div>

                    <h3 class="admin-card-title">
                        Carousel
                    </h3>

                    <p class="admin-card-description">
                        Manage homepage slides
                    </p>

                </div>

            </a>

        </div>

        <!-- PRODUCTS -->
        <div class="col-md-6 col-xl-4">

            <a href="{{ route('admin.products') }}"
               class="text-decoration-none">

                <div class="admin-dashboard-card products-card">

                    <div class="admin-card-icon">
                        📦
                    </div>

                    <h3 class="admin-card-title">
                        Products
                    </h3>

                    <p class="admin-card-description">
                        Add, edit, and manage products
                    </p>

                </div>

            </a>

        </div>

        <!-- CATEGORIES -->
        <div class="col-md-6 col-xl-4">

            <a href="{{ route('admin.categories') }}"
               class="text-decoration-none">

                <div class="admin-dashboard-card categories-card">

                    <div class="admin-card-icon">
                        🗂️
                    </div>

                    <h3 class="admin-card-title">
                        Categories
                    </h3>

                    <p class="admin-card-description">
                        Organize your products
                    </p>

                </div>

            </a>

        </div>

        <!-- ORDERS -->
        <div class="col-md-6 col-xl-4">

            <a href="{{ route('admin.orders') }}"
               class="text-decoration-none">

                <div class="admin-dashboard-card orders-card">

                    <div class="admin-card-icon">
                        🛒
                    </div>

                    <h3 class="admin-card-title">
                        Orders
                    </h3>

                    <p class="admin-card-description">
                        Track and manage customer orders
                    </p>

                </div>

            </a>

        </div>

    </div>

</section>

</x-layout>