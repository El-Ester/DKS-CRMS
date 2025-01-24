

<div class="sidebar">
    <div class="logo-details">
        {{-- <i class="bi bi-people"></i> --}}
        <img src="{{ asset('images/unissalogo.png') }}" alt="Logo" class="logo-class">
</div>

<div>
    <span class="logo_name">Job Opportunities!</span>
</div>


<ul class="nav-links">
    <li>
        <a href="{{ route('candidates.dashboard') }}">
            <i class='home-icon bx bx-home'></i>
            <span class="link_name">Home</span>
        </a>
        <ul class="sub-menu blank">
            <li><a class="link_name" href="{{ route('candidates.dashboard') }}">Home</a></li>
        </ul>
    </li>
        <li>
            <div class="iocn-link">
                <a href="{{ route('hrd.manage_hiring.index') }}">
                    <i class='user-icon bx bx-user'></i>
                    <span class="link_name" href="{{ route('hrd.manage_hiring.index') }}">Hiring</span>
                </a>
                <i class='bx bxs-chevron-down arrow' href="{{ route('hrd.manage_hiring.index') }}"></i>
            </div>
        </li>

        <li>
            <div class="profile-details">
                {{-- <div class="profile-content">
                    <!--<img src="image/profile.jpg" alt="profileImg">-->
                </div>
                <div class="name-job">
                    <div class="profile_name">{{ Auth::user()->username }}</div>
                    <div class="job">{{ Auth::user()->first_name }}</div>
                </div> --}}
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" style="background: none ; border-style: none"><i
                            class='bx bx-log-out'></i></button>
                </form>
            </div>
        </li>
    </ul>
</ul>
</div>

