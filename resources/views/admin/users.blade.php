<x-layout>

<div class="container mt-5">

  <!-- Title -->
  <h2 class="mb-4 fw-bold text-center">Users Management</h2>

  <!-- Success -->
  @if(session('success'))
    <div class="alert alert-success text-center">
      {{ session('success') }}
    </div>
  @endif

    @if(session('error'))
    <div class="alert alert-danger text-center">
      {{ session('error') }}
    </div>
  @endif

  <div class="card shadow-sm p-3">

    <div class="table-responsive">
      <table class="table table-hover align-middle text-center">

        <!-- Header -->
        <thead class="table-light">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Change Role</th>
            <th>Delete</th>
          </tr>
        </thead>

        <!-- Body -->
        <tbody>

          @forelse ($users as $user)
          <tr>

            <td class="fw-bold">{{ $user->id }}</td>

            <td>{{ $user->name }}</td>

            <td class="text-muted">{{ $user->email }}</td>

            <!-- Role -->
            <td>
              <span class="badge 
                {{ $user->role == 'admin' ? 'bg-success' : 'bg-secondary' }}">
                {{ ucfirst($user->role) }}
              </span>
            </td>

            <!-- Change Role -->
            <td>
              <form action="{{ route('admin.toggleRole', $user->id) }}" method="POST">
                @csrf
                <button class="btn btn-sm btn-warning">
                  {{ $user->role == 'admin' ? 'Make User' : 'Make Admin' }}
                </button>
              </form>
            </td>

            <!-- Delete -->
            <td>
              <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST"
                    onsubmit="return confirm('Delete this user?');">
                @csrf
                <button class="btn btn-sm btn-danger">
                  Delete
                </button>
              </form>
            </td>

          </tr>
          @empty
            <tr>
              <td colspan="6" class="text-muted text-center">
                No users found.
              </td>
            </tr>
          @endforelse

        </tbody>

      </table>
    </div>

  </div>

</div>

</x-layout>