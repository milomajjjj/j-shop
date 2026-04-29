<nav class="navbar navbar-expand-lg">
  <div class="container">

    <!-- Logo -->
    <a class="navbar-brand fw-bold" href="{{ route('home') }}" style="font-size: 1.25rem; letter-spacing: -0.5px; color: var(--primary);">
      J Shop
    </a>

    <!-- Mobile toggle -->
    <button
      class="navbar-toggler border-0"
      type="button"
      data-bs-toggle="collapse"
      data-bs-target="#navbarContent"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbarContent">

      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1">

        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') ? 'active fw-semibold' : '' }}"
             href="{{ route('home') }}"
             style="color: var(--text); transition: color 0.2s;">
            Home
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('products.filter') }}" style="color: var(--text); transition: color 0.2s;">
            Products
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('cart.index') }}" style="color: var(--text); transition: color 0.2s;">
            🛒 Cart
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('orders.index') }}" style="color: var(--text); transition: color 0.2s;">
            Orders
          </a>
        </li>

        @auth
        @if(auth()->user()->role === 'admin')
        <li class="nav-item">
          <a class="nav-link fw-semibold" href="{{ route('admin.home') }}" style="color: var(--danger);">
            ⚙️ Admin
          </a>
        </li>
        @endif
        @endauth

      </ul>

      <!-- Right side -->
      <div class="d-flex align-items-center gap-2 flex-wrap">

        <!-- Search -->
        <form class="d-flex" action="{{ route('search') }}" method="GET">
          <input
            class="form-control form-control-sm me-2"
            type="search"
            name="q"
            placeholder="Search products..."
            value="{{ request('q') }}"
            style="min-width: 180px; border-color: var(--border);"
          />
          <button class="btn btn-sm btn-primary" type="submit">
            🔍
          </button>
        </form>

        <!-- Theme Toggle -->
        <button id="themeToggle" class="btn btn-sm btn-outline-secondary border-0" style="width: 38px; height: 38px; border-radius: 50%; padding: 0;">
          🌙
        </button>

        <!-- Auth buttons -->
        @guest
          <a class="btn btn-sm btn-outline-primary" href="{{ route('login') }}">
            Sign in
          </a>
          <a class="btn btn-sm btn-primary" href="{{ route('register') }}">
            Register
          </a>
        @endguest

        @auth
          <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button class="btn btn-sm btn-outline-danger" type="submit">
              Logout
            </button>
          </form>
        @endauth

      </div>

    </div>
  </div>
</nav>