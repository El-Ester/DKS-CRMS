<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/unissalogo.jpg') }}" type="image/jpeg">
    <title>Online Job Application</title>
    <link rel="stylesheet" href="{{ asset('css/candidateDashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

@include('components.candidate.header')
@include('components.candidate.sidebar')

<body>
    <section class="home-section bg-lightblue">
            <i class='bx bx-menu'></i>


        <div class="container text-center">
            <div class="row mb-4">
                <div class="col-12">
                    <img src="{{ asset('images/unissalogo.png') }}" alt="University Logo" class="mb-3">
                    <p class="mb-0">Online Job Application</p>
                    <h4 class="mt-2">WELCOME @auth {{ Auth::user()->name }} @else Guest! @endauth</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <a href="#" class="text-decoration-none">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/general_info.jpg') }}" class="card-img-top" alt="General Info">
                            <div class="card-body">
                                <h5 class="card-title">Maklumat Am & Panduan</h5>
                                <p class="card-text"><i>General Info</i></p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-3">
                    <a href="#" class="text-decoration-none">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/latest_advertisement.jpg') }}" class="card-img-top" alt="Latest Advertisement">
                            <div class="card-body">
                                <h5 class="card-title">Iklan Terkini</h5>
                                <p class="card-text"><i>Latest Advertisement</i></p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-4 mb-3">
                    <a href="#" class="text-decoration-none">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/terms.jpg') }}" class="card-img-top" alt="Terms of Appointment">
                            <div class="card-body">
                                <h5 class="card-title">Syarat-syarat Lantikan</h5>
                                <p class="card-text"><i>Terms of Appointment</i></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <a href="#" class="text-decoration-none">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/post_application.jpg') }}" class="card-img-top" alt="Post Application">
                            <div class="card-body">
                                <h5 class="card-title">Permohonan/Kemaskini Jawatan</h5>
                                <p class="card-text"><i>Post Application/Update</i></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="#" class="text-decoration-none">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/update_profile.jpg') }}" class="card-img-top" alt="Update Profile">
                            <div class="card-body">
                                <h5 class="card-title">Maklumat Pemohon</h5>
                                <p class="card-text"><i>Update Profile</i></p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 mb-3">
                    <a href="#" class="text-decoration-none">
                        <div class="card shadow-sm">
                            <img src="{{ asset('images/upload_photo.jpg') }}" class="card-img-top" alt="Upload Photo">
                            <div class="card-body">
                                <h5 class="card-title">Muatnaik Gambar</h5>
                                <p class="card-text"><i>Upload Photo</i></p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
@include('components.candidate.footer')
