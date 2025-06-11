<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="{{ asset('images/DKS_Logo_no.bg.png') }}" type="image/jpeg">
        <title>View Case</title>
        <link rel="stylesheet" href="{{ asset('css/AddCases.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    </head>

    @include('components.admin.header')
    @include('components.admin.sidebar')

    <body>
        <section class="home-section">
            <div class="container">
                <h2>Create New Role</h2>
                <form action="{{ route('systemAdmin.storeRole') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Role Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter role name" value="{{ old('name') }}" required>
                    </div>

                    <button type="submit" class="btn btn-success">Create Role</button>
                    <a href="{{ route('systemAdmin.roleManagement') }}" class="btn btn-secondary">Cancel</a>
                </form>
        </section>
    </body>
</html>
@include('components.admin.footer')
