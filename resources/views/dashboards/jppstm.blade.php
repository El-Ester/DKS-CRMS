@include('components.jppstm.header')
@include('components.jppstm.sidebar')

@section('content')
<section class="home-section bg-lightblue">
    <div class="home-content">
        <i class='bx bx-menu'></i>
        <span class="text text-black">Welcome, Mr/Mrs {{ Auth::user()->username }}!</span>
    </div>

    <div class="container mt-5">
        <h1>JPPSTM Dashboard</h1>
        <p>Welcome, {{ Auth::user()->name }}! This is your JPPSTM dashboard where you can manage various tasks related to the recruitment process.</p>

        <!-- Example: Feature widgets -->
        <div class="quick-links">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="#">Manage Recruitment</a></li>
                <li><a href="#">Manage Applicants</a></li>
                <li><a href="#">Manage Interviews</a></li>
            </ul>
        </div>

        <!-- Contribution Areas -->
        <div class="contribution-areas">
            <div class="feature">
                <h4>Manage Job Details</h4>
                <p>Click here to add or edit job postings for the recruitment process.</p>
                <a href="#" class="btn btn-primary">Manage Jobs</a>
            </div>

            <div class="feature">
                <h4>Manage Applicants</h4>
                <p>Review applicant listings and finalize the shortlist for interview selection.</p>
                <a href="#" class="btn btn-primary">Manage Applicants</a>
            </div>

            <div class="feature">
                <h4>Manage Interviews</h4>
                <p>Schedule and manage interview details for selected applicants.</p>
                <a href="#" class="btn btn-primary">Manage Interviews</a>
            </div>
        </div>
    </div>
</section>

<style>
    .home-section {
        background-color: #d2d2d2;
        padding: 20px;
    }

    .home-content {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.5rem;
        color: #333;
    }

    .container {
        margin-top: 20px;
        padding: 20px;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1, h3, h4 {
        color: #565656;
    }

    .quick-links ul {
        list-style: none;
        padding-left: 0;
    }

    .quick-links ul li {
        margin: 10px 0;
    }

    .quick-links ul li a {
        color: #007bff;
        text-decoration: none;
    }

    .quick-links ul li a:hover {
        text-decoration: underline;
    }

    .contribution-areas {
        display: flex;
        gap: 20px;
        margin-top: 30px;
    }

    .feature {
        flex: 1;
        background-color: #f9f9f9;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .feature h4 {
        font-size: 1.2rem;
        margin-bottom: 10px;
    }

    .feature p {
        font-size: 1rem;
        margin-bottom: 15px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }
</style>

    @include('components.jppstm.footer')
