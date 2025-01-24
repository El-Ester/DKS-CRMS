<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title ?? "HRMS"}}</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebarCandidate.css') }}" rel="stylesheet">


    <link rel="icon" href="https://png.pngtree.com/png-vector/20220724/ourmid/pngtree-profile-icon-profile-account-employee-vector-png-image_38122508.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="header">
        <div class="name-job">
            <i class="bi bi-person"></i>
            <div class="profile_name">
                @if(Auth::guard('candidate')->check())
                    {{ Auth::guard('candidate')->user()->name }}
                @else
                    Guest
                @endif
            </div>
        </div>


        <div class="sign-out">
            <form action="{{ route('candidate.logout') }}" method="post">
                @csrf
                <button type="submit" style="background: none; border-style: none">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>

        </div>
    </div>
</body>
</html>
