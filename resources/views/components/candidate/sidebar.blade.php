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


            <ul class="nav-links">
                <li>
                    <a href="{{ route('candidate.dashboard') }}">
                        <i class='home-icon bx bx-home'></i>
                        <span class="link_name">Home</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('jobs.index') }}">
                        <i class='bx bx-briefcase'></i>
                        <span class="link_name">Job Application</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="applicant-info">
                        <i class='bx bx-user'></i>
                        <span class="link_name">Applicant Information</span>
                        <i class='bx bx-chevron-down arrow'></i> <!-- Down arrow icon -->
                    </a>
                    <ul class="sub-menu">
                        <li><a href="{{ route('personal_details.create') }}">Personal Details</a></li>
                        <li>
                            <a href="#" class="toggle-qualification">
                                <span class="link_name">Qualification</span>
                                <i class="bi bi-arrow-down-short"></i> <!-- Down arrow icon -->
                            </a>
                            <ul class="q-sub-menu">
                                <li><a href="{{ route('school-qualifications.form') }}">Upper Secondary</a></li>
                                <li><a href="{{ route('higher-qualifications.form')}}">Higher Education</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('training.form') }}">Training</a></li>
                        <li><a href="{{ route('employment.form') }}">Employment</a></li>
                        <li><a href="{{ route('family-details.form')}}">Family Details</a></li>
                        <li><a href="{{ route('referee.form') }}">Referees</a></li>
                        <li><a href="#">Declaration</a></li>
                    </ul>
                </li>





                <li>
                    <a href="{{ route('upload.picture') }}">
                        <i class='bx bx-image'></i>
                        <span class="link_name">Upload Picture</span>
                    </a>
                </li>


                <li>
                    <a href="#">
                        <i class='bx bx-printer'></i>
                        <span class="link_name">Print Application</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class='bx bx-search'></i>
                        <span class="link_name">Check Application</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class='bx bx-key'></i>
                        <span class="link_name">Change Password</span>
                    </a>
                </li>

                {{-- <li>
                    <div class="profile-details">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" style="background: none; border-style: none">
                                <i class='bx bx-log-out'></i>
                            </button>
                        </form>
                    </div>
                </li> --}}
            </ul>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Toggle Applicant Information submenu
                    document.querySelector('.applicant-info').addEventListener('click', function(event) {
                        event.preventDefault(); // Prevent default action
                        this.parentElement.classList.toggle('active');

                        // Hide Qualification submenu when Applicant Information is toggled
                        document.querySelector('.q-sub-menu').classList.remove('active');
                    });

                    // Toggle Qualification submenu
                    document.querySelector('.toggle-qualification').addEventListener('click', function(event) {
                        event.preventDefault(); // Prevent default action
                        document.querySelector('.q-sub-menu').classList.toggle('active');
                    });
                });


            </script>

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

        </div>
    </body>
</html>
