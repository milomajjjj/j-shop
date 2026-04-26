<x-layout>

<div class="container mt-5" style="max-width: 400px;">
  <div class="card p-4 shadow-sm">

    <h4 class="mb-3 text-center">New Password</h4>

    <form method="POST" action="{{ route('password.update') }}">
      @csrf

      <input type="hidden" name="token" value="{{ $token }}">

      <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>

      <input type="password" name="password" class="form-control mb-2" placeholder="New Password" required>

      <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Confirm Password" required>

      <button class="btn btn-success w-100">
        Reset Password
      </button>
    </form>

  </div>
</div>

</x-layout>