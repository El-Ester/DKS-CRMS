<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Online Job Application</title>
        <link rel="stylesheet" href="{{ asset('css/jobindex.css') }}">
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
                <a href="{{ route('frontpage.frontpage') }}">Home</a>
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
                <h2 class="sub-heading">
                    @switch($filter)
                        @case('academic_post_local')
                            Academic Post - Local
                            @break
                        @case('non_academic_post_local')
                            Non-Academic Post - Local
                            @break
                        @case('academic_post_expatriates')
                            Academic Post - Expatriates
                            @break
                        @default
                            All
                    @endswitch
                </h2>
        </section>

        <!-- Job Advertisements Section -->
        <h3 class="center">Job Opportunities</h3>

        <div class="job_type">
            <nav>
                <a href="{{ route('frontpage.index', ['filter' => 'all']) }}"
                   class="{{ $filter === 'all' ? 'open' : '' }}">All</a>

                <a href="{{ route('frontpage.index', ['filter' => 'academic_post_local']) }}"
                   class="{{ $filter === 'academic_post_local' ? 'open' : '' }}">Academic Post - Local</a>

                <a href="{{ route('frontpage.index', ['filter' => 'non_academic_post_local']) }}"
                   class="{{ $filter === 'non_academic_post_local' ? 'open' : '' }}">Non-Academic Post - Local</a>

                <a href="{{ route('frontpage.index', ['filter' => 'academic_post_expatriates']) }}"
                   class="{{ $filter === 'academic_post_expatriates' ? 'open' : '' }}">Academic Post - Expatriates</a>
            </nav>
        </div>


        @forelse($jobs as $job)
            <div class="job-card">
                <img src="{{ asset('images/unissalogo2.jpg') }}" alt="University Logo" class="job-logo" />

                <!-- Job Title -->
                <h4 class="position">Position: {{ $job->title }}</h4>

                <!-- Location -->
                <p><strong>Location:</strong> Sultan Sharif Ali Islamic University (UNISSA)</p>

                <!-- Closing Date -->
                <p>
                    <strong>Closing Date:</strong>
                    {{ \Carbon\Carbon::parse($job->close_date)->format('F d, Y') }}
                </p>

                <!-- Action Buttons -->
                <div class="action-button">
                    <a href="{{ route('frontpage.job.details', ['id' => $job->id]) }}" class="details-btn">Read More</a>
                </div>
            </div>
        @empty
            <p class="notAvailable">No job vacancies available at the moment. Thank You!</p>
        @endforelse
    </body>
</html>
