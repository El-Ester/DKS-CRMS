<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Job Advertisements</title>
        <link rel="stylesheet" href="{{ asset('css/jobDetails.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    </head>

    <body>
        <!-- Header Section -->
        <header>
            <div>
                <img src="{{ asset('images/unissalogo1.png') }}" alt="Logo" class="logo">
            </div>
                <nav>
                    <a href="{{ url('/') }}">Home</a>
                    <a href="#">About Us</a>
                    <a href="#">Staff Directory</a>
                    <a href="#">News & Events</a>
                    <a href="{{ route('login') }}">HRMS Login</a>
                    <a href="#">Downloads</a>
                    <a href="#">Gallery</a>
                    <a href="#">Location</a>
                </nav>
        </header>

            <section class="hero1">
                <h1>CAREER</h1>
            </section>

            <div class="container">
                <h2 class="title">{{ $job->title }}</h2>
                <div class="close-date">Closing Date: {{ $job->close_date ?? 'N/A' }}</div>

                <div class="vacancy-details">
                    <p><strong>Job Description:</strong></p>
                    <p class="desc">{{ $job->description }}</p>
                </div>

                <div class="requirements">
                    <p><strong>Minimum Requirements</strong></p>
                    <p class="desc">@foreach (explode("\n", $job->min_requirements ?? 'N/A') as $item)
                        <p>- {{ trim($item) }}</p>
                    @endforeach</p>
                </div>

                <div class="docs">
                    <p><strong>Documents Required</strong></p>
                    <p class="desc">@foreach (explode("\n", $job->document_required ?? 'N/A') as $item)
                        <p>- {{ trim($item) }}</p>
                    @endforeach</p>
                </div>

                <div class="payment-period">
                    <div><strong>Payment:</strong> BND {{ $job->payment_amount ?? 'N/A' }} {{ ucfirst(str_replace('_', ' ', $job->payment_type ?? 'N/A')) }}</div>
                    <div><strong>Working Period:</strong> {{ $job->working_period ?? 'N/A' }} {{ ucfirst($job->working_period ?? 'N/A') }}</div>
                </div>

                <div class="actions">
                    <a href="{{ route('frontpage.index') }}" class="btn btn-secondary">Back</a>
                    <a href="{{ route('candidate.login') }}" class="btn btn-primary">Apply</a>
                </div>
            </div>
    </body>
</html>
