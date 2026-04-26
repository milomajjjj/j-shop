<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">

    <!-- Logo -->
    <a class="navbar-brand fw-bold text-primary" href="{{ route('home') }}">
      J Shop
    </a>

    <!-- Mobile toggle -->
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarContent"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbarContent">

      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active fw-bold' : '' }}"
             href="{{ route('home') }}">
            Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('products.filter') }}">Products</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('cart.index') }}">
            🛒 Cart
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('orders.index') }}">
            Orders
          </a>
        </li>
        

        @auth
        @if(auth()->user()->role === 'admin')
        <li class="nav-item">
          <a class="nav-link text-danger fw-bold" href="{{ route('admin.home') }}">
            Admin
          </a>
        </li>
        @endif
        @endauth

        <button id="themeToggle" class="btn btn-sm btn-dark ms-2">
             🌙
         </button>

      </ul>

      <!-- Right side -->
      <div class="d-flex align-items-center gap-3">

        <!-- Search -->
        <form class="d-flex" action="{{ route('search') }}" method="GET">
          <input
            class="form-control me-2"
            type="search"
            name="q"
            placeholder="Search..."
            value="{{ request('q') }}"
          />
          <button class="btn btn-outline-primary">
            Search
          </button>
        </form>

        <!-- Auth buttons -->
        @guest
          <a class="btn btn-outline-primary" href="{{ route('login') }}">
            Sign in
          </a>
          <a class="btn btn-primary" href="{{ route('register') }}">
            Register
          </a>
        @endguest

        @auth
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline-danger">
              Logout
            </button>
          </form>
        @endauth

      </div>

    </div>
  </div>
</nav>