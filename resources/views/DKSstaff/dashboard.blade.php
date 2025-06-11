<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/unissalogo.jpg') }}" type="image/jpeg">
    <title>Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('images/DKS_Logo_no.bg.png') }}">
    <link rel="stylesheet" href="{{ asset('css/StaffDashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

@include('components.staff.header')
@include('components.staff.sidebar')

<body>
    <section class="home-section">

        <div class="container mt-5">
            <h2 class="mb-4 text-center">Dashboard</h2>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title text-center">Case Status Distribution</h5>
                            <canvas id="statusChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title text-center">Monthly Case Submissions</h5>
                            <canvas id="monthChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="card-title text-center">Cases by User Role</h5>
                            <canvas id="roleChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Chart.js script --}}
    <script>
        // Case Status Distribution Chart
        new Chart(document.getElementById('statusChart'), {
            type: 'pie',
            data: {
                labels: {!! json_encode($statusLabels) !!},
                datasets: [{
                    data: {!! json_encode($statusCounts) !!},
                    backgroundColor: ['#0d6efd', '#ffc107', '#198754', '#dc3545', '#6c757d']
                }]
            }
        });

        // Monthly Case Submissions Chart
        new Chart(document.getElementById('monthChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthLabels) !!},
                datasets: [{
                    label: 'Cases',
                    data: {!! json_encode($monthCounts) !!},
                    backgroundColor: '#20c997'
                }]
            }
        });

        // Cases by User Role Chart
        new Chart(document.getElementById('roleChart'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($roleLabels) !!},
                datasets: [{
                    data: {!! json_encode($roleCounts) !!},
                    backgroundColor: ['#6610f2', '#fd7e14', '#0dcaf0']
                }]
            }
        });
    </script>
</body>
</html>
@include('components.staff.footer')
