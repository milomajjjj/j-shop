<x-layout>

<section class="container py-5">

    <!-- HEADER -->
    <div class="text-center mb-5">

        <h1 class="admin-main-title">
            Users Management
        </h1>

        <p class="section-subtitle">
            Manage registered users and permissions
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

    <!-- ERROR -->
    @if(session('error'))

        <div class="alert alert-danger text-center mb-4">
            {{ session('error') }}
        </div>

    @endif

    <!-- USERS TABLE -->
    <div class="carousel-admin-card">

        <div class="table-responsive">

            <table class="table premium-orders-table align-middle text-center">

                <!-- HEADER -->
                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Name</th>

                        <th>Email</th>

                        <th>Role</th>

                        <th>Change Role</th>

                        <th>Delete</th>

                    </tr>

                </thead>

                <!-- BODY -->
                <tbody>

                    @forelse ($users as $user)

                    <tr>

                        <!-- ID -->
                        <td class="fw-bold">

                            #{{ $user->id }}

                        </td>

                        <!-- NAME -->
                        <td class="fw-bold">

                            {{ $user->name }}

                        </td>

                        <!-- EMAIL -->
                        <td class="text-muted">

                            {{ $user->email }}

                        </td>

                        <!-- ROLE -->
                        <td>

                            @if($user->role == 'admin')

                                <span class="premium-status-badge delivered-status">
                                    Admin
                                </span>

                            @else

                                <span class="premium-status-badge pending-status">
                                    User
                                </span>

                            @endif

                        </td>

                        <!-- CHANGE ROLE -->
                        <td>

                            <form action="{{ route('admin.toggleRole', $user->id) }}"
                                  method="POST">

                                @csrf

                                <button class="change-role-btn">

                                    {{ $user->role == 'admin'
                                        ? 'Make User'
                                        : 'Make Admin'
                                    }}

                                </button>

                            </form>

                        </td>

                        <!-- DELETE -->
                        <td>

                            <form action="{{ route('admin.deleteUser', $user->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this user?');">

                                @csrf

                                <button class="delete-user-btn">

                                    Delete

                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="6" class="text-center py-5 text-muted">

                            No users found.

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</section>

</x-layout>