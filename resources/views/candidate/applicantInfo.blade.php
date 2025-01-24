<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Applicant Information</title>
    <link rel="stylesheet" href="{{ asset('css/applicantInfo.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

@include('components.candidate.header')
@include('components.candidate.sidebar')

<body>
    <section class="home-section bg-lightblue">
            <i class='bx bx-menu'></i>


        <div class="container">
            <h1>Personal Details</h1>
            <form action="{{ route('jobApplications.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Job ID (Hidden) -->
                <input type="hidden" name="job_id" value="1"> <!-- Replace "1" with your desired job ID -->



                <!-- Personal Information -->
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', session('form_data.name')) }}" required>
                </div>

                <div class="mb-3">
                    <label for="ic_no" class="form-label">IC Number</label>
                    <input type="text" name="ic_no" id="ic_no" class="form-control" value="{{ old('ic_no', session('form_data.ic_no')) }}" required>
                </div>

                <div class="mb-3">
                    <label for="date_of_birth" class="form-label">Date of Birth</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" value="{{ old('date_of_birth', session('form_data.date_of_birth')) }}" required>
                </div>

                <div class="mb-3">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" name="age" id="age" class="form-control" value="{{ old('age', session('form_data.age')) }}" required>
                </div>

                <div class="mb-3">
                    <label for="place_of_birth" class="form-label">Place of Birth</label>
                    <input type="text" name="place_of_birth" id="place_of_birth" class="form-control" value="{{ old('place_of_birth', session('form_data.place_of_birth')) }}" required>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label">Gender</label>
                    <select name="gender" id="gender" class="form-control" required>
                        <option value="male" {{ (session('form_data.gender') == 'male' ? 'selected' : '') }}>Male</option>
                        <option value="female" {{ (session('form_data.gender') == 'female' ? 'selected' : '') }}>Female</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="marital_status" class="form-label">Marital Status</label>
                    <select name="marital_status" id="marital_status" class="form-control" required>
                        <option value="single" {{ (session('form_data.marital_status') == 'single' ? 'selected' : '') }}>Single</option>
                        <option value="married" {{ (session('form_data.marital_status') == 'married' ? 'selected' : '') }}>Married</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="race" class="form-label">Race</label>
                    <input type="text" name="race" id="race" class="form-control" value="{{ old('race') }}">
                </div>


                <!-- Contact Information -->
                <div class="mb-3">
                    <label for="telephone_mobile" class="form-label">Mobile Number</label>
                    <input type="text" name="telephone_mobile" id="telephone_mobile" class="form-control" value="{{ old('telephone_mobile', session('form_data.telephone_mobile')) }}" required>
                </div>

                <div class="mb-3">
                    <label for="email_address" class="form-label">Email Address</label>
                    <input type="email" name="email_address" id="email_address" class="form-control" value="{{ old('email_address', session('form_data.email_address')) }}" required>
                </div>

                <!-- Address -->
                <div class="mb-3">
                    <label for="permanent_address" class="form-label">Permanent Address</label>
                    <textarea name="permanent_address" id="permanent_address" class="form-control" required>{{ old('permanent_address', session('form_data.permanent_address')) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="postal_address" class="form-label">Postal Address</label>
                    <textarea name="postal_address" id="postal_address" class="form-control">{{ old('postal_address', session('form_data.postal_address')) }}</textarea>
                </div>

                <!-- Documents -->
                <div class="mb-3">
                    <label for="passport_photo" class="form-label">Passport Photo</label>
                    <input type="file" name="passport_photo" id="passport_photo" class="form-control" accept="image/*" >
                </div>

                <div class="mb-3">
                    <label for="cv_path" class="form-label">Upload CV</label>
                    <input type="file" name="cv_path" id="cv_path" class="form-control" accept=".pdf,.doc,.docx" >
                </div>

                <!-- Cover Letter -->
                <div class="mb-3">
                    <label for="cover_letter" class="form-label">Cover Letter</label>
                    <textarea name="cover_letter" id="cover_letter" class="form-control" rows="5" required>{{ old('cover_letter', session('form_data.cover_letter')) }}</textarea>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-primary">Save</button>
            </form>

        </div>
    </section>
</body>
</html>
@include('components.candidate.footer')
