<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HRD Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/hrdDashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

@include('components.private.header')
@include('components.private.sidebar')

<body>
    <section class="home-section bg-lightblue">
            <i class='bx bx-menu'></i>

        <div class="container mt-5">
            <span class="text text-black">Welcome, Mr/Mrs {{ Auth::user()->username }}!</span>
            <h1>Executive Summary Dashboard</h1>
            <p>Gives leadership a quick look at key workforce indicators like demographics, new hires, departures, and open roles. Insights are visual and easy to understand.</p>

            <!-- Dashboard Overview -->
            <div class="row text-center">
                <!-- Demographics -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4>Demographics</h4>
                            <h5>1,998</h5>
                            <p>Head Count</p>
                            <p><b>893</b> Female, <b>1,105</b> Male</p>
                        </div>
                    </div>
                </div>

                <!-- Hires -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4>Hires</h4>
                            <h5>957</h5>
                            <p>543 Permanent, 414 Temporary</p>
                        </div>
                    </div>
                </div>

                <!-- Open Positions -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4>Open Positions</h4>
                            <h5>1,017</h5>
                            <p>575 Regular, 442 Contract</p>
                        </div>
                    </div>
                </div>

                <!-- Terminations -->
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4>Terminations</h4>
                            <h5>928</h5>
                            <p>510 Full-Time, 418 Part-Time</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts and Visual Insights -->
            <div class="row mt-5">
                <!-- Employees by Organization -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Employees by Organization</h5>
                            <img src="/path-to-image/employees-by-organization.jpg" alt="Employees by Organization" class="img-fluid">
                        </div>
                    </div>
                </div>

                <!-- Hires by Business Unit -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Hires by Business Unit</h5>
                            <img src="/path-to-image/hires-by-business-unit.jpg" alt="Hires by Business Unit" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <!-- Open Positions by Grade -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Open Positions by Grade</h5>
                            <img src="/path-to-image/open-positions-by-grade.jpg" alt="Open Positions by Grade" class="img-fluid">
                        </div>
                    </div>
                </div>

                <!-- Terminations by Organization -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5>Terminations by Organization</h5>
                            <img src="/path-to-image/terminations-by-organization.jpg" alt="Terminations by Organization" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
@include('components.private.footer')
