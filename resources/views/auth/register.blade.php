<x-layout>

  <main class="auth-bg d-flex justify-content-center align-items-center" style="min-height:100vh;">

<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">

  <div class="card shadow-sm p-4" style="width: 100%; max-width: 450px;">

    <!-- Title -->
    <h3 class="text-center text-primary fw-bold mb-4">
      Create Account
    </h3>

    <form action="{{ route('registerAction') }}" method="POST">
      @csrf

      <!-- Name -->
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input
          type="text"
          name="name"
          class="form-control"
          value="{{ old('name') }}"
          required
        >
        @error('name')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <!-- Email -->
      <div class="mb-3">
        <label class="form-label">Email address</label>
        <input
          type="email"
          name="email"
          class="form-control"
          value="{{ old('email') }}"
          required
        >
        @error('email')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <!-- Password -->
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input
          type="password"
          name="password"
          class="form-control"
          required
        >
        @error('password')
          <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>

      <!-- Confirm -->
      <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input
          type="password"
          name="password_confirmation"
          class="form-control"
          required
        >
      </div>

      <!-- Terms -->
      <div class="form-check mb-3">
        <input type="checkbox" name="terms" class="form-check-input" id="terms">
        <label class="form-check-label" for="terms">
          I agree to <a href="#">terms of policy</a>
        </label>
      </div>
      @error('terms')
        <small class="text-danger d-block mb-2">{{ $message }}</small>
      @enderror

      <!-- Button -->
      <button type="submit" class="btn btn-primary w-100">
        Create Account
      </button>

      <!-- Link -->
      <p class="text-center mt-3 small text-muted">
        Already have an account?
        <a href="{{ route('login') }}">Sign in</a>
      </p>

    </form>

  </div>

</div>
  </main>
</x-layout>