<x-layout>

<div class="container mt-5" style="max-width: 400px;">
  <div class="card p-4 shadow-sm">

    <h4 class="mb-3 text-center">Reset Password</h4>

    @if(session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <input type="email" name="email" class="form-control mb-3" placeholder="Enter your email" required>

      <button class="btn btn-primary w-100">
        Send Reset Link
      </button>
    </form>

  </div>
</div>

</x-layout>