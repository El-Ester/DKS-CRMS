<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management</title>
    <link rel="icon" href="{{ asset('images/DKS_Logo_no.bg.png') }}" type="image/png">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/Roles.css') }}">
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
                <h2 class="mb-4">Role Management</h2>

                <a href="{{ route('systemAdmin.createNewRole') }}" class="btn btn-primary mb-3"><i class="fas fa-user-plus me-1"></i>New Role</a>

                <div class="table-responsive">
                    <table id="roleTable">
                        <thead>
                            <tr>
                                <th>Role ID</th>
                                <th>Role Title</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ $role->role_id }}</td>
                                <td>{{ $role->role_title }}</td>
                                <td>
                                    <form action="{{ route('role.destroy', $role->role_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this role?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
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
            $('#roleTable').DataTable({
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

