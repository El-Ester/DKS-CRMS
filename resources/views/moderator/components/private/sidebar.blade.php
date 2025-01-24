<div class="public function store">
    <div class="logo-details">
        <i class="bi bi-award-fill"></i>
    </div>
    <div class="logo-details">
        <span class="logo_name">Human Resoursce Department</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="/home">
                <i class='home-icon bx bx-home'></i>
                <span class="link_name">Home</span>
            </a>
            <ul class="sub-menu blank">
                <li><a class="link_name" href="/home">Home</a></li>
            </ul>
        </li>

        <li>
            <div class="iocn-link">
                <a href="#">
                    <i class="bi bi-bar-chart"></i>
                    <span class="link_name">OBE Process</span>
                </a>
                <i class='bx bxs-chevron-down arrow'></i>
            </div>
            <ul class="sub-menu">
                <li><a class="link_name" href="#">OBE Process</a></li>
                <li><a href="">Add / Create Program</a></li>
                <li><a href="">Establish Vision & Mission</a></li>
                <li><a href="">Add Course</a></li>
                <li><a href="">State PO</a></li>
                <li><a href="">Create Academic Session</a></li>
            </ul>
        </li>

        <li>
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
                    <button type="submit" style="background: none ; border-style: none"><i class='bx bx-log-out'></i></button>
                </form>
            </div>
        </li>
    </ul>
</div>

<style>
    /* Sidebar base styles */
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100vh;
    background-color: #458dd6;

    padding-top: 20px;
    transition: width 0.3s;
}

.sidebar.close {
    width: 80px;
}

/* Logo section */
.logo-details {
    display: flex;
    align-items: center;
    gap: 10px;
    padding-left: 20px;
}

.logo-details i {
    align-items: center;
}

.logo_name {
    font-size: 10px;
    text-align: center;
    font-weight: bold;
    display: inline-block;
    transition: opacity 0.3s;
}

.sidebar.close .logo_name {
    opacity: 0;
    display: none;
}

/* Navigation links */
.nav-links {
    list-style: none;
    padding: 0;
    margin-top: 20px;
}

.nav-links li {
    position: relative;
}

.nav-links li a {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    color: #bdc3c7;
    text-decoration: none;
    transition: background-color 0.3s;
}

.nav-links li a:hover {
    background-color: #34495e;
    color: #fff;
}

.nav-links li .sub-menu {
    display: none;
    list-style: none;
    padding-left: 20px;
}

.nav-links li .iocn-link:hover .sub-menu {
    display: block;
}

.nav-links li .sub-menu li a {
    color: #bdc3c7;
}

.nav-links li .sub-menu li a:hover {
    background-color: #34495e;
    color: #fff;
}

.nav-links li .iocn-link i {
    font-size: 20px;
}

.nav-links li .arrow {
    margin-left: auto;
    font-size: 18px;
}

.nav-links li .iocn-link:hover .arrow {
    transform: rotate(180deg);
}

/* Profile section */
.profile-details {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    position: absolute;
    bottom: 20px;
    left: 0;
    width: 100%;
    background-color: #34495e;
    color: #fff;
}

.profile-content {
    width: 40px;
    height: 40px;
    background-color: #fff;
    border-radius: 50%;
    overflow: hidden;
    margin-right: 10px;
}

.profile-name {
    font-size: 16px;
    font-weight: bold;
}

.job {
    font-size: 14px;
}

.profile-details form button {
    background: none;
    border: none;
    color: #fff;
    cursor: pointer;
    font-size: 20px;
    margin-left: auto;
}

.profile-details form button:hover {
    color: #e74c3c;
}

/* Sidebar toggle styles */
.sidebar-toggle {
    position: absolute;
    top: 20px;
    right: -40px;
    background-color: #2c3e50;
    color: #fff;
    padding: 10px;
    cursor: pointer;
    border-radius: 5px;
}

/* For small screen sizes */
@media (max-width: 768px) {
    .sidebar {
        width: 80px;
    }

    .logo_name {
        display: none;
    }

    .nav-links li a {
        justify-content: center;
    }
}

</style>
