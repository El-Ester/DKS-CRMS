<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/unissalogo.jpg') }}" type="image/jpeg">
    <title>Upload Picture</title>
    <link rel="stylesheet" href="{{ asset('css/uploadPicture.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    @include('components.candidate.header')
    @include('components.candidate.sidebar')

    <section class="home-section bg-lightblue py-4">

        <div class="container">
            <h1>Upload Picture</h1>
            <hr>

            <form action="{{ url('/upload-picture') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="picture" class="form-label">jpeg, png, jpg:</label>
                    <input type="file" id="picture" name="picture" accept=".jpeg,.jpg,.png" class="form-control" value="{{ $picture->picture ?? '' }}" required>
                </div>

                <!-- Image Preview (Placed below the input field) -->
                <div id="imagePreview" class="mt-3">
                    <img id="preview" src="" alt="Preview" class="img-fluid" style="max-width: 200px; max-height: 200px; display: none; border: 1px solid #cccccc; border-radius: 5px;">
                </div>

                <button type="submit" class="btn btn-primary">Upload</button>
            </form>

            <!-- Display uploaded image after successful upload -->
            @if(session('picturePath'))
            <div class="mt-4">
                <h3>Uploaded Picture:</h3>
                <img src="{{ asset('storage/' . session('picturePath')) }}" alt="Uploaded Picture" class="img-fluid" style="max-width: 500px; max-height: 500px; object-fit: contain;">
            </div>
            @elseif($data && $data->picture)
            <div class="mt-4">
                <h3>Your Picture:</h3>
                <img src="{{ asset('storage/' . $data->picture) }}" alt="Current Picture" class="img-fluid" style="max-width: 500px; max-height: 500px; object-fit: contain;">
                <div class="mt-2">
                    <button type="button" class="btn btn-secondary" id="changePictureBtn">Change Picture</button>
                    <form action="{{ url('/remove-picture') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Remove Picture</button>
                    </form>
                </div>
            </div>
            @endif



        </div>
    </section>

    <script>
        // Preview image before upload
        document.getElementById('picture').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const previewImage = document.getElementById('preview');
                previewImage.src = e.target.result;
                previewImage.style.display = 'block';  // Show the preview
            };

            if (file) {
                reader.readAsDataURL(file);  // Read the file and trigger onload
            }
        });

        // Show the "Change Picture" form when the button is clicked
        document.getElementById('changePictureBtn').addEventListener('click', function() {
            const form = document.getElementById('changePictureForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        });
    </script>

    @include('components.candidate.footer')
</body>
</html>
