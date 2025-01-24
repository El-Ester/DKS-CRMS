<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/unissalogo.jpg') }}" type="image/jpeg">
    <title>Qualification</title>
    <link rel="stylesheet" href="{{ asset('css/higher-qualification.css') }}">
    <!-- Bootstrap CSS (Make sure this is correctly loaded) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

@include('components.candidate.header')
@include('components.candidate.sidebar')

<body>
    <section class="home-section bg-lightblue">
        <i class='bx bx-menu'></i>

        <div class="container py-4">
            <h1>Qualifications Details</h1>
            <hr>
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>QUALIFICATIONS [HIGHER EDUCATION AND PROFESSIONAL QUALIFICATIONS]</h2>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addHigherQualificationModal">
                    <i class="bi bi-plus-circle"></i> Add
                </button>
            </div>

            <!-- Add Higher Qualifications Modal -->
            <div class="modal fade" id="addHigherQualificationModal" tabindex="-1" aria-labelledby="addHigherQualificationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addHigherQualificationModalLabel">Add Qualification Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('higher-qualifications.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                                @csrf

                                    <!-- Qualification Type Dropdown -->
                                    <div class="form-group">
                                        <label for="qualification_type">QUALIFICATIONS OBTAINED: </label>
                                        <select class="form-control" id="qualification_type" name="qualification_type" required onchange="updateResultOptions()">
                                            <option value="">--select--</option>
                                            <option value="ND">Ordinary National Diploma (ND) or Equivalent</option>
                                            <option value="HND">Higher National Diploma (HND) or Equivalent</option>
                                            <option value="BA">First Degree (BA) or Equivalent</option>
                                            <option value="MA">Master Degree (MA) or Equivalent</option>
                                        </select>
                                    </div>

                                    <div id="qualification_details" class="mt-3">
                                        <div id="ND" class="qualification-section">
                                            <h3 id="qualification-title"><i>Qualification Obtained</i></h3>


                                            <!-- College/University Name -->
                                            <div class="form-group">
                                                <label for="university_name" class="form-label">College/University Name</label>
                                                <input type="text" class="form-control" id="university_name" name="university_name" required>
                                            </div>

                                            <!-- College/University Country -->
                                            <div class="form-group">
                                                <label for="university_country" class="form-label">College/University Country</label>
                                                <input type="text" class="form-control" id="university_country" name="university_country">
                                            </div>

                                            <!-- Certificate Name -->
                                            <div class="form-group">
                                                <label for="certificate_name" class="form-label">Certificate Name</label>
                                                <input type="text" class="form-control" id="certificate_name" name="certificate_name">
                                            </div>

                                            <!-- Certificate Date -->
                                            <div class="form-group">
                                                <label for="certificate_date" class="form-label">Certificate Date</label>
                                                <input type="date" class="form-control" id="certificate_date" name="certificate_date">
                                            </div>

                                            <!-- Overall Result -->
                                            <div class="form-group">
                                                <label for="overall_result" class="form-label">Overall Result</label>
                                                <input type="text" class="form-control" id="overall_result" name="overall_result" required>
                                            </div>

                                            <!--COURSE TAKEN adn Result-->
                                            <div class="form-group">
                                                <label for="courses" class="form-label">Courses</label>
                                                <div id="courses-container">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <input type="text" class="form-control mb-2" name="courses_taken[]" placeholder="Enter course">
                                                        <input type="text" class="form-control mb-2" name="courses_result[]" placeholder="Enter result">
                                                    </div>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-warning" id="add-course">Add Course</button>
                                                    <button type="button" class="btn btn-danger remove-course" style="display:none;">Remove</button>
                                                </div>
                                            </div>

                                            <!-- MOE Accreditation -->
                                            <div class="form-group">
                                                <label for="moe_accreditation" class="form-label">MOE Accreditation</label>
                                                <input type="text" class="form-control" id="moe_accreditation" name="moe_accreditation">
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                
                                </div>
                            </form>
                    </div>
                </div>
            </div>

            <!--QUALIFICATION DISPLAY-->
            <div class="qualification-display">
                @if($qualifications->isNotEmpty())
                    @foreach($qualifications as $qualification)
                        <div class="mb-4">
                            <p class="fw-bold">
                                <span class="text-uppercase">
                                    @switch($qualification->qualification_type)
                                        @case ('ND')
                                            Ordinary National Diploma (ND) or Equivalent
                                            @break;
                                        @case ('HND')
                                            Higher National Diploma (HND) or Equivalent
                                            @break;
                                        @case ('BA')
                                            First Degree (BA) or Equivalent
                                            @break;
                                        @case ('MA')
                                            Master Degree (MA) or Equivalent
                                            @break;
                                        @default
                                            {{ $qualification->qualification_type ?? '' }}
                                    @endswitch
                                </span>
                            </p>
                            <p class="text"><strong>College / University Name: </strong> <span>{{ $qualification->university_name ?? '' }}</span></p>
                            <p class="text"><strong>College / University Country: </strong> <span>{{ $qualification->university_country ?? '' }}</span></p>
                            <p class="text"><strong>Certificate Name: </strong> <span>{{ $qualification->certificate_name ?? '' }}</span></p>
                            <p class="text"><strong>Certificate Date: </strong> <span>{{ $qualification->certificate_date ?? '' }}</span></p>
                            <p class="text"><strong>Result: </strong> <span>{{ $qualification->overall_result ?? '' }}</span></p>

                            <h6>Subject / Courses Taken & Results:</h6>
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Subject</th>
                                        <th>Result</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($courses as $course)
                                        <tr>
                                            <td>{{ $course->course_name }}</td>
                                            <td>{{ $course->course_result }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <form action="{{ route('higher-qualifications.destroy', $qualification->id)}}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                        <hr class="my-4">
                    @endforeach
                    @else
                        <p class="text-center">No qualification added. Please add your qualifications.</p>
                @endif
            </div>
        </div>

    </section>

    <!-- Bootstrap JS (Make sure this is loaded correctly) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add course-result pair dynamically
            document.getElementById('add-course').addEventListener('click', function() {
                var coursesContainer = document.getElementById('courses-container');
                var newCourseDiv = document.createElement('div');
                newCourseDiv.classList.add('d-flex', 'justify-content-between', 'align-items-center');
                newCourseDiv.innerHTML = `
                    <input type="text" class="form-control mb-2" name="courses_taken[]" placeholder="Enter course">
                    <input type="text" class="form-control mb-2" name="courses_result[]" placeholder="Enter result">
                    <button type="button" class="btn btn-danger remove-course">Remove</button>
                `;
                coursesContainer.appendChild(newCourseDiv);

                // Show remove button
                newCourseDiv.querySelector('.remove-course').style.display = 'inline-block';

                // Remove course-result pair
                newCourseDiv.querySelector('.remove-course').addEventListener('click', function() {
                    newCourseDiv.remove();
                });
            });

            // Change the heading based on selected qualification
            document.getElementById('qualification_type').addEventListener('change', function() {
                var selectedQualification = this.value;
                var titleElement = document.getElementById('qualification-title');

                switch (selectedQualification) {
                    case 'ND':
                        titleElement.textContent = "Ordinary National Diploma (ND) or Equivalent";
                        break;
                    case 'HND':
                        titleElement.textContent = "Higher National Diploma (HND) or Equivalent";
                        break;
                    case 'BA':
                        titleElement.textContent = "First Degree (BA) or Equivalent";
                        break;
                    case 'MA':
                        titleElement.textContent = "Master Degree (MA) or Equivalent";
                        break;
                    default:
                        titleElement.textContent = "Select"; // Default Value
                }
            });
        });
    </script>


    @include('components.candidate.footer')
</body>
</html>
