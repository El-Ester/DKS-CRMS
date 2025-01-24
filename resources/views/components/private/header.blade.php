<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title ?? "HRMS"}}</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">


    <link rel="icon" href="https://png.pngtree.com/png-vector/20220724/ourmid/pngtree-profile-icon-profile-account-employee-vector-png-image_38122508.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="header">
        {{-- <div class="menu-icon">
            <i class="bi bi-list"></i>
        </div> --}}

        <!-- User Info: Display the user's name only if authenticated -->
        {{-- <div class="profile-details"> --}}
            {{-- <div class="profile-content">
                <!--<img src="image/profile.jpg" alt="profileImg">-->
            </div> --}}
                <div class="name-job">
                    <i class="bi bi-person"></i>
                    <div class="profile_name">{{ Auth::user()->username }}</div>
                    {{-- <div class="job">{{ Auth::user()->first_name }}</div> --}}
                </div>

            <div class="sign-out">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" style="background: none; border-style: none">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        {{-- </div> --}}
    </div>
</body>
</html>

