<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/unissalogo.jpg') }}" type="image/jpeg">
    <title>Training</title>
    <link rel="stylesheet" href="{{ asset('css/training.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

@include('components.candidate.header')
@include('components.candidate.sidebar')

<body>
    <section class="home-section bg-lightblue">
            <i class='bx bx-menu'></i>

            <div class="container py-4">
                <h1>Training Details</h1>

                <hr>

                <!-- ADD TRAINING MODAL -->
                <div class="modal fade" id="addTrainingModal" tabindex="-1" aria-labelledby="addTrainingModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addTrainingModalLabel">Add Training</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('training.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                                    @csrf

                                    <!-- Training Type Dropdown -->
                                    <div class="mb-3">
                                        <label for="training_type" class="form-label">Training Type: </label>
                                        <select class="form-select" id="training_type" name="training_type" required>
                                            <option value="" disabled selected>Select Training Type</option>
                                            <option value="Technical Training">Technical Training</option>
                                            <option value="Leadership and Management">Leadership and Management</option>
                                            <option value="Soft Skills">Soft Skills</option>
                                            <option value="Compliance">Compliance</option>
                                            <option value="Safety and Health">Safety and Health</option>
                                            <option value="Industry-Specific">Industry-Specific</option>
                                            <option value="Sales and Marketing">Sales and Marketing</option>
                                            <option value="Technology and Digital Tools">Technology and Digital Tools</option>
                                            <option value="Creative and Personal Development">Creative and Personal Development</option>
                                            <option value="Professional Certification">Professional Certification</option>
                                            <option value="Employee Onboarding and Orientation">Employee Onboarding and Orientation</option>
                                            <option value="Language and Cultural Training">Language and Cultural Training</option>
                                            <option value="Research and Development">Research and Development</option>
                                            <option value="Entrepreneurship">Entrepreneurship</option>
                                            <option value="Wellness and Lifestyle">Wellness and Lifestyle</option>
                                        </select>

                                    </div>

                                    <!-- Training Name Input -->
                                    <div class="mb-3">
                                        <label for="training_name" class="form-label">Training Name: </label>
                                        <input type="text" class="form-control" id="training_name" name="training_name" required>
                                    </div>

                                    <!-- Other Fields -->
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Date: </label>
                                        <input type="date" class="form-control" id="date" name="date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="organiser" class="form-label">Organiser:</label>
                                        <input type="text" class="form-control" id="organiser" name="organiser" required>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TRAINING DISPLAY -->
                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#addTrainingModal">
                    <i class="bi bi-plus-circle"></i> Add
                </button>

                <div class="table responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Training Type</th>
                                <th>Training Name</th>
                                <th>Date</th>
                                <th>Organiser</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($trainings as $training)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $training->training_type }}</td>
                                <td>{{ $training->training_name }}</td>
                                <td>{{ $training->date }}</td>
                                <td>{{ $training->organiser }}</td>
                                <td>
                                    <div class="action-icons">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editTrainingModal{{ $training->id }}" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- EDIT MODAL -->
                                        <div class="modal fade" id="editTrainingModal{{ $training->id }}" tabindex="-1" aria-labelledby="editTrainingModalLabel{{ $training->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editTrainingModalLabel{{ $training->id}}">Edit Training Details</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('training.update', $training->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')

                                                            <!-- Training Type Dropdown -->
                                                            <div class="mb-3">
                                                                <label for="training_type{{ $training->id }}" class="form-label">Training Type: </label>
                                                                <select class="form-select" id="training_type{{ $training->id }}" name="training_type" required>
                                                                    <option value="" disabled {{ $training->training_type == '' ? 'selected' : '' }}>Select Training Type</option>
                                                                    <option value="Technical" {{ $training->training_type == 'Technical' ? 'selected' : '' }}>Technical</option>
                                                                    <option value="Leadership and Management" {{ $training->training_type == 'Leadership and Management' ? 'selected' : '' }}>Leadership and Management</option>
                                                                    <option value="Soft Skills" {{ $training->training_type == 'Soft Skills' ? 'selected' : '' }}>Soft Skills</option>
                                                                    <option value="Compliance" {{ $training->training_type == 'Compliance' ? 'selected' : '' }}>Compliance</option>
                                                                    <option value="Safety and Health" {{ $training->training_type == 'Safety and Health' ? 'selected' : '' }}>Safety and Health</option>
                                                                    <option value="Industry-Specific" {{ $training->training_type == 'Industry-Specific' ? 'selected' : '' }}>Industry-Specific</option>
                                                                    <option value="Sales and Marketing" {{ $training->training_type == 'Sales and Marketing' ? 'selected' : '' }}>Sales and Marketing</option>
                                                                    <option value="Technology and Digital Tools" {{ $training->training_type == 'Technology and Digital Tools' ? 'selected' : '' }}>Technology and Digital Tools</option>
                                                                    <option value="Creative and Personal Development" {{ $training->training_type == 'Creative and Personal Development' ? 'selected' : '' }}>Creative and Personal Development</option>
                                                                    <option value="Professional Certification" {{ $training->training_type == 'Professional Certification' ? 'selected' : '' }}>Professional Certification</option>
                                                                    <option value="Employee Onboarding and Orientation" {{ $training->training_type == 'Employee Onboarding and Orientation' ? 'selected' : '' }}>Employee Onboarding and Orientation</option>
                                                                    <option value="Language and Cultural Training" {{ $training->training_type == 'Language and Cultural Training' ? 'selected' : '' }}>Language and Cultural Training</option>
                                                                    <option value="Research and Development" {{ $training->training_type == 'Research and Development' ? 'selected' : '' }}>Research and Development</option>
                                                                    <option value="Entrepreneurship" {{ $training->training_type == 'Entrepreneurship' ? 'selected' : '' }}>Entrepreneurship</option>
                                                                    <option value="Wellness and Lifestyle" {{ $training->training_type == 'Wellness and Lifestyle' ? 'selected' : '' }}>Wellness and Lifestyle</option>
                                                                    <option value="Other" {{ $training->training_type == 'Other' ? 'selected' : '' }}>Other</option>
                                                                </select>

                                                            </div>

                                                            <!-- Other Fields -->
                                                            <div class="mb-3">
                                                                <label for="training_name{{ $training->id }}" class="form-label">Training Name: </label>
                                                                <input type="text" class="form-control" id="training_name{{ $training->id }}" name="training_name" value="{{ $training->training_name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="date{{ $training->id }}" class="form-label">Date: </label>
                                                                <input type="date" class="form-control" id="date{{ $training->id }}" name="date" value="{{ $training->date }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="organiser{{ $training->id }}" class="form-label">Organiser:</label>
                                                                <input type="text" class="form-control" id="organizer{{ $training->id }}" name="organiser" value="{{ $training->organiser }}" required>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success">Update</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <form action="{{ route('training.destroy', $training->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

    </section>
</body>
</html>
@include('components.candidate.footer')
