<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <link rel="icon" href="{{ asset('images/DKS_Logo_no.bg.png') }}" type="image/png">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/Users.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
</head>
<body>
    @include('components.admin.header')
    @include('components.admin.sidebar')

    <section class="home-section">
        <div class="container-fluid px-4 py-4">
            <h2 class="mb-4">User Management</h2>

            <a href="{{ route('systemAdmin.createNewUser') }}" class="btn btn-primary mb-3">
                <i class="fas fa-user-plus me-1"></i>  New User
            </a>

            <div class="table-responsive">
                <table id="userTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->user_id }}</td>
                            <td>{{ $user->user_name }}</td>
                            <td>{{ $user->user_full_name }}</td>
                            <td>{{ $user->user_email }}</td>
                            <td>{{ $user->role->role_title ?? 'N/A' }}</td>
                            <td>{{ $user->is_suspended ? 'Suspended' : 'Active' }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->user_id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('users.destroy', $user->user_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    @include('components.admin.footer')

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#userTable').DataTable({
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search..."
                }
            });

            @if(session('success'))
                toastr.success("{{ session('success') }}");
            @endif
            @if(session('error'))
                toastr.error("{{ session('error') }}");
            @endif
            @if(session('info'))
                toastr.info("{{ session('info') }}");
            @endif
            @if(session('warning'))
                toastr.warning("{{ session('warning') }}");
            @endif
        });
    </script>
</body>
</html>
