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
        <!-- Include Toastr CSS -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

        <!-- Include jQuery (required for Toastr) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- Include Toastr JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    </head>

    <body>
        <div class="sidebar">
            <div class="logo-details">
                {{-- <i class="bi bi-people"></i> --}}
                <img src="{{ asset('images/unissalogo.png') }}" alt="Logo" class="logo-class">
            </div>

                <div>
                    <span class="logo_name">Human Resource e-Recruitment System</span>
                </div>


                    <ul class="nav-links">

                        <li>
                            <a href="{{ route('hrd.dashboard') }}">
                                <i class='home-icon bx bx-home'></i>
                                <span class="link_name">HRD Dashboard</span>
                            </a>
                            {{-- <ul class="sub-menu blank">
                                <li><a class="link_name" href="{{ route('hrd.dashboard') }}">HRD Dashboard</a></li>
                            </ul> --}}
                        </li>


                        <li>
                            <div class="iocn-link">
                                <a href="{{ route('hrd.manage_hiring.index') }}">
                                    <i class="bi bi-search"></i>
                                    <span class="link_name" href="{{ route('hrd.manage_hiring.index') }}">Hiring</span>
                                </a>
                            </div>
                        </li>

                        {{-- <li>
                            <div class="iocn-link">
                                <a href="{{ route('hrd.manage_employees.index') }}">
                                    <i class='user-icon bx bx-user'></i>
                                    <span class="link_name">Employees</span>
                                </a>
                            </div>
                        </li>

                        <li>
                            <div class="iocn-link">
                                <a href="#">
                                    <i class='user-icon bi bi-currency-dollar'></i>
                                    <span class="link_name">Payroll & Benefits</span>
                                </a>
                            </div>
                        </li>

                        <li>
                            <div class="iocn-link">
                                <a href="#">
                                    <i class='user-icon bi bi-calendar-check'></i>
                                    <span class="link_name">Attendance & Leave</span>
                                </a>
                            </div>
                        </li>

                        <li>
                            <div class="iocn-link">
                                <a href="#">
                                    <i class='user-icon bi bi-bar-chart'></i>
                                    <span class="link_name">Performance Management</span>
                                </a>
                            </div>
                        </li>

                        <li>
                            <div class="iocn-link">
                                <a href="#">
                                    <i class='user-icon bi bi-journal-bookmark'></i>
                                    <span class="link_name">Training & Development</span>
                                </a>
                            </div>
                        </li>

                        <li>
                            <div class="iocn-link">
                                <a href="#">
                                    <i class='user-icon bi bi-gear'></i>
                                    <span class="link_name">Settings</span>
                                </a>
                            </div>
                        </li> --}}

                        {{-- <li>
                            <div class="profile-details">
                                <div class="profile-content">
                                    <!--<img src="image/profile.jpg" alt="profileImg">-->
                                </div>
                                <div class="name-job">
                                    <div class="profile_name">{{ Auth::user()->username }}</div>
                                    <div class="job">{{ Auth::user()->first_name }}</div>
                                </div>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" style="background: none ; border-style: none"><i
                                            class='bx bx-log-out'></i></button>
                                </form>
                            </div>
                        </li> --}}
                    </ul>
        </div>
<!-- Toastr Notifications Script -->
<script type="text/javascript">
    @if(session('success'))
        toastr.success("{{ session('success') }}");
    @elseif(session('error'))
        toastr.error("{{ session('error') }}");
    @elseif(session('info'))
        toastr.info("{{ session('info') }}");
    @elseif(session('warning'))
        toastr.warning("{{ session('warning') }}");
    @endif
</script>

    </body>
</html>
