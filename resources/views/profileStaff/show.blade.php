<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/DKS_Logo_no.bg.png') }}" type="image/jpeg">
    <title>View Case</title>
    <link rel="stylesheet" href="{{ asset('css/Show.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>

@include('components.staff.header')
@include('components.staff.sidebar')

<body>
    <section class="home-section">
        <div class="container mt-4">
            <h2>User Profile</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card p-4 shadow-sm">
                <div class="row mb-3">
                    <label class="col-sm-3 fw-bold">Name:</label>
                    <div class="col-sm-9">{{ Auth::user()->user_name }}</div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 fw-bold">Email:</label>
                    <div class="col-sm-9">{{ Auth::user()->user_email }}</div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 fw-bold">Role:</label>
                    <div class="col-sm-9">{{ Auth::user()->role->role_title ?? 'N/A' }}</div>
                </div>

                <div class="mt-3 d-flex gap-2">
                    <a href="{{ route('DKSstaff.dashboard') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                    <a href="{{ route('profileStaff.edit') }}" class="btn btn-primary">Update Password</a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
@include('components.staff.footer')
