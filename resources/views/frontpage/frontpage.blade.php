<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Office of Human Resources</title>
        <link rel="stylesheet" href="{{ asset('css/frontpage.css') }}">
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

            <!-- Hero Section -->
            <section class="hero">
                <h1>Office of Human Resources</h1>
            </section>

            <!-- Main Content -->
            <div class="container">
                <!-- Left: Contact Info -->
                <aside class="contact-info">
                    <h3>Contact Info</h3>
                    <p><strong>Universiti Islam Sultan Sharif Ali</strong><br>
                        Spg 347, Jalan Pasar Gadong<br>
                        BE 1310 Negara Brunei Darussalam.</p>
                    <p><strong>Tel:</strong> +673 2462000 Ext. 184/251</p>
                    <p><strong>Hotline:</strong> +673 8687055</p>
                    <p><strong>Email:</strong> <a href="mailto:hrd.unissa@unissa.edu.bn">hrd.unissa@unissa.edu.bn</a></p>

                    <h3>Working Hours</h3>
                    <p>Monday – Thursday & Saturday<br>
                    8:00 a.m. – 12:00 p.m. | 2:00 p.m. – 4:00 p.m.</p>
                </aside>

                <!-- Right: Main Content -->
                <div class="content">
                    <h2>Background</h2>
                        <p>The Human Resources Office at the Sultan Sharif Ali Islamic University (UNISSA) is responsible for managing all aspects related to the university’s workforce, including human resource management, staff selection and recruitment, job placement, staff development and training, as well as maintenance of personal records. The Human Resources Office at UNISSA plays a crucial role in ensuring effective and progressive human resource management for the university. Through efforts in human resource management, the university can ensure efficiency, effectiveness, and staff satisfaction, thereby supporting the overall mission and goals of the university.</p>

                    <h2>Objectives</h2>
                    <ul>
                        <li>To provide an up-to-date and relevant human resources management services in accordance with the best practices and good governance.</li>
                        <li>To maximize the value of human contribution through recruitment, selection, employment, placement, development, rewards, engagement, and retention of well-qualified, committed, and diverse faculty and staff.</li>
                        <li>To provide funding and support for learning, growth, and development of its staff.</li>
                        <li>To implement and manage compliance and ethics policies within the university.</li>
                        <li>To serve as the secretariat of the Human Resource and Management Department Committee which has an internal reporting system concerning employment matters.</li>
                    </ul>
                </div>
            </div>

            <section class="hero1">
                <h1>CAREER</h1>
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
