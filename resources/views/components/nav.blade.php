<nav class="navbar navbar-expand-lg premium-navbar">

    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand premium-logo d-flex align-items-center gap-3"
   href="{{ route('home') }}">

    <div class="logo-icon">
        ⚡
    </div>

    <span class="logo-text">
        JShop
    </span>

</a>

        <!-- MOBILE -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">

            <!-- LINKS -->
            <ul class="navbar-nav mx-auto gap-lg-4 mt-3 mt-lg-0">

                <li class="nav-item">
                    <a class="nav-link premium-link {{ request()->routeIs('home') ? 'active-link' : '' }}"
                       href="{{ route('home') }}">
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link premium-link"
                       href="{{ route('products.filter') }}">
                        Products
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link premium-link"
                      href="{{ route('cart.index') }}">
                        Cart
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link premium-link"
                       href="{{ route('orders.index') }}">
                        Orders
                    </a>
                </li>

                @auth
                @if(auth()->user()->role === 'admin')
                <li class="nav-item">
                    <a class="nav-link premium-link admin-link"
                       href="{{ route('admin.home') }}">
                        Admin
                    </a>
                </li>
                @endif
                @endauth

            </ul>

            <!-- RIGHT -->
            <div class="d-flex align-items-center gap-2 flex-wrap mt-3 mt-lg-0">

                <!-- SEARCH -->
                <form class="search-box d-flex" action="{{ route('search') }}" method="GET">

                    <input
                        class="form-control premium-search"
                        type="search"
                        name="q"
                         placeholder="Search products..."
                        value="{{ request('q') }}"
                    />

                    <button class="search-btn" type="submit">
                        🔍
                    </button>

                </form>

                @guest
                    <a class="btn premium-outline-btn" href="{{ route('login') }}">
                        Sign In
                    </a>

                    <a class="btn gradient-btn" href="{{ route('register') }}">
                        Register
                    </a>
                @endguest

                @auth
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf

                        <button class="btn premium-outline-danger" type="submit">
                            Logout
                        </button>
                    </form>
                @endauth

            </div>

        </div>

    </div>
</nav>