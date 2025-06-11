<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ $title ?? "CRMS" }}</title>
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet" />
    <link rel="icon" href="https://png.pngtree.com/png-vector/20220724/ourmid/pngtree-profile-icon-profile-account-employee-vector-png-image_38122508.png" type="image/x-icon" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet" />
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <img src="{{ asset('images/DKS_Logo_no.bg.png') }}" alt="Logo" class="logo-class" />
        </div>

        <div class="logo_name">
            <span class="logo_name">CRMS</span>
        </div>

        <ul class="nav-links">
            <li>
                <a href="{{ route('DKSstaff.dashboard') }}">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span class="link_name">Dashboard</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="{{ route('DKSstaff.dashboard') }}">Dashboard</a></li>
                </ul>
            </li>

            <li>
                <div class="iocn-link">
                    <a href="#">
                        <i class="fa-solid fa-file"></i>
                        <span class="link_name">Cases</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                </div>
                <ul class="sub-menu">
                    <li><a href="{{ route('DKSstaff.addNewCase') }}">Add Cases</a></li>
                    <li><a href="{{ route('cases.index') }}">View Cases</a></li>
                    <li><a href="#">Update Cases</a></li>
                </ul>
            </li>

            <li class="logout-link mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link text-decoration-none">
                        <u>Sign Out</u>
                    </button>
                </form>
            </li>
        </ul>

    </div>

    <!-- jQuery (required by Toastr) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Sidebar dropdown toggle script -->
    <script>
        document.querySelectorAll('.iocn-link').forEach(iconLink => {
            iconLink.addEventListener('click', function(e) {
                e.preventDefault();
                const parent = this.parentElement;
                parent.classList.toggle('showMenu');
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
</body>
</html>
