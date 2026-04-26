<x-layout>

  <main class="auth-bg d-flex justify-content-center align-items-center" style="min-height:100vh;">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">

  <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">

    <!-- Title -->
    <h3 class="text-center text-primary fw-bold mb-4">
      Sign In
    </h3>

    <!-- Error -->
    @if(session('error'))
      <div class="alert alert-danger text-center">
        {{ session('error') }}
      </div>
    @endif

    <form action="{{ route('loginAction') }}" method="POST">
      @csrf

      <!-- Email -->
      <div class="mb-3">
        <label class="form-label">Email address</label>
        <input
          type="email"
          class="form-control"
          name="email"
          value="{{ old('email') }}"
          required
        >
      </div>

      <!-- Password -->
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input
          type="password"
          class="form-control"
          name="password"
          required
        >
      </div>

      <!-- Remember -->
      <div class="form-check mb-3">
        <input type="checkbox" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">
          Remember me
        </label>
      </div>
      <div class="text-end mb-3">
  <a href="{{ route('password.request') }}" class="small">
    Forgot Password?
  </a>
</div>

      <!-- Button -->
      <button type="submit" class="btn btn-primary w-100">
        Sign In
      </button>

      <!-- Link -->
      <p class="text-center mt-3 small text-muted">
        Don't have an account?
        <a href="{{ route('register') }}">Sign up</a>
      </p>

    </form>

  </div>

</div>
  </main>
</x-layout>