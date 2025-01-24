<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ isset($job) ? 'Edit' : 'Create' }} Job Opportunities</title>
        <link rel="stylesheet" href="{{ asset('css/hiringCreate.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>

    <body>
        @include('components.private.header')
        @include('components.private.sidebar')

        <section class="home-section bg-lightblue">
            <i class='bx bx-menu'></i>

            <div class="container">
                <button class="close" type="button" onclick="window.location.href='{{ route('hrd.manage_hiring.index') }}';">
                    <i class="fas fa-times"></i>
                </button>

                <h1>{{ isset($job) ? 'Edit Job' : 'Create Job' }}</h1>
                <form action="{{ isset($job) ? route('hrd.manage_hiring.update', $job->id) : route('hrd.manage_hiring.store') }}" method="POST">
                    @csrf
                    @if(isset($job)) @method('PUT') @endif

                    <!-- Title Section -->
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Enter job title" value="{{ old('title', $job->title ?? '') }}" required>
                    </div>

                    <!-- Description Section -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" placeholder="Enter job description" rows="4" required>{{ old('description', $job->description ?? '') }}</textarea>
                    </div>

                    <!-- Payment Section -->
                    <div class="mb-3">
                        <label for="payment" class="form-label">Payment</label>
                        <div class="d-flex">
                            <input type="number" name="payment_amount" id="payment_amount" class="form-control me-2" placeholder="Enter payment amount" value="{{ old('payment_amount', $job->payment_amount ?? '') }}" required>
                            <select name="payment_type" id="payment_type" class="form-control" required>
                                <option value="" disabled {{ !isset($job) ? 'selected' : '' }}>Select type</option>
                                <option value="per_day" {{ old('payment_type', $job->payment_type ?? '') === 'per_day' ? 'selected' : '' }}>/Day</option>
                                <option value="per_month" {{ old('payment_type', $job->payment_type ?? '') === 'per_month' ? 'selected' : '' }}>/Month</option>
                                <option value="per_year" {{ old('payment_type', $job->payment_type ?? '') === 'per_year' ? 'selected' : '' }}>/Year</option>
                            </select>
                        </div>
                    </div>

                    <!-- Working Period -->
                    <div class="mb-3">
                        <label for="working_period" class="form-label">Working Period</label>
                        <input type="text" name="working_period" id="working_period"  class="form-control" value="{{ old('working_period', $job->working_period ?? '') }}" required placeholder="e.g. 12 months, 3 years">
                    </div>

                    <!-- Education Level -->
                    <div class="mb-3">
                        <label for="education" class="form-label">Education Level Required</label>
                        <input type="text" name="education" id="education" class="form-control" placeholder="e.g. bachelor's degree, master's degree, doctorate degree" value="{{ old('education', $job->education ?? '') }}" required>
                    </div>

                    <!-- Skills -->
                    <div class="mb-3">
                        <label for="skills" class="form-label">Skills Required</label>
                        <div id="skills-container">
                            @foreach (old('skills', $job->skills ?? []) as $skill)
                                <div class="skill-group">
                                    <select name="skills[]" class="form-select mb-2" required>
                                        <option value="{{ $skill }}" selected>{{ $skill }}</option>
                                        <option value="Problem solving">Problem solving</option>
                                        <option value="Teamwork">Teamwork</option>
                                        <option value="Leadership">Leadership</option>
                                        <option value="Creativity">Creativity</option>
                                        <option value="Time management">Time management</option>
                                        <option value="Adaptability">Adaptability</option>
                                        <option value="Critical thinking">Critical thinking</option>
                                        <option value="Emotional intelligence">Emotional intelligence</option>
                                        <option value="Interpersonal communication">Interpersonal communication</option>
                                        <option value="Computer literacy">Computer literacy</option>
                                        <option value="Skills management">Skills management</option>
                                        <option value="Initiative">Initiative</option>
                                        <option value="Management">Management</option>
                                        <option value="Resilience">Resilience</option>
                                        <option value="Decision-making">Decision-making</option>
                                        <option value="Active listening">Active listening</option>
                                        <option value="Confidence">Confidence</option>
                                        <option value="Data analysis">Data analysis</option>
                                        <option value="Organization">Organization</option>
                                        <option value="Professionalism">Professionalism</option>
                                        <option value="Communication">Communication</option>
                                        <option value="Collaboration">Collaboration</option>
                                        <option value="Leadership skills">Leadership skills</option>
                                        <option value="Organisational skills">Organisational skills</option>
                                    </select>
                                    <button type="button" class="btn btn-danger remove-skill-btn">Remove</button>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" class="btn btn-primary" id="add-skill-btn">Add</button>
                    </div>

                    <!-- Experience -->
                    <div class="mb-3">
                        <label for="experience" class="form-label">Experience Required</label>
                        <input type="number" class="form-control" id="experience" name="experience" value="{{ old('experience', $job->experience ?? '') }}" required>
                    </div>

                    <!-- Document Required Section -->
                    <div class="mb-3">
                        <label for="document_required" class="form-label">Document Required</label>
                        <textarea name="document_required" id="document_required" class="form-control" placeholder="Enter documents required" rows="3" required>{{ old('document_required', $job->document_required ?? '') }}</textarea>
                    </div>

                    <!-- Open and Close Dates -->
                    <div class="mb-3">
                        <label for="open-date" class="form-label">Open Date:</label>
                        <input type="date" name="open_date" class="form-control" value="{{ old('open_date', $job->open_date ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="close-date" class="form-label">Close Date:</label>
                        <input type="date" name="close_date" class="form-control" value="{{ old('close_date', $job->close_date ?? '') }}" required>
                    </div>

                    <!-- Job Type -->
                    <div class="mb-3">
                        <label for="job_type" class="form-label">Job Type</label>
                        <select name="job_type" id="job_type" class="form-control" required>
                            <option value="" disabled {{ !isset($job) ? 'selected' : '' }}>Select job type</option>
                            <option value="academic_post_local" {{ old('job_type', $job->job_type ?? '') === 'academic_post_local' ? 'selected' : '' }}>Academic Post - Local</option>
                            <option value="non_academic_post_local" {{ old('job_type', $job->job_type ?? '') === 'non_academic_post_local' ? 'selected' : '' }}>Non-Academic Post - Local</option>
                            <option value="academic_post_expatriates" {{ old('job_type', $job->job_type ?? '') === 'academic_post_expatriates' ? 'selected' : '' }}>Academic Post - Expatriates</option>
                        </select>
                    </div>

                    <!-- Status Section -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="" disabled {{ !isset($job) ? 'selected' : '' }}>Select status</option>
                            <option value="draft" {{ old('status', $job->status ?? '') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="open" {{ old('status', $job->status ?? '') === 'open' ? 'selected' : '' }}>Open</option>
                            <option value="closed" {{ old('status', $job->status ?? '') === 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">{{ isset($job) ? 'Update Job' : 'Create Job' }}</button>
                    </div>
                </form>
            </div>
        </section>

        <script>
            // Handle adding and removing skills dynamically
            const addSkillBtn = document.getElementById('add-skill-btn');
            const skillsContainer = document.getElementById('skills-container');

            addSkillBtn.addEventListener('click', () => {
                const skillGroup = document.createElement('div');
                skillGroup.classList.add('skill-group');

                const select = document.createElement('select');
                select.classList.add('form-select', 'mb-2');
                select.name = 'skills[]';
                select.innerHTML = `
                    <option value="Problem solving">Problem solving</option>
                    <option value="Teamwork">Teamwork</option>
                    <option value="Leadership">Leadership</option>
                    <option value="Creativity">Creativity</option>
                    <option value="Time management">Time management</option>
                    <option value="Adaptability">Adaptability</option>
                    <option value="Critical thinking">Critical thinking</option>
                    <option value="Emotional intelligence">Emotional intelligence</option>
                    <option value="Interpersonal communication">Interpersonal communication</option>
                    <option value="Computer literacy">Computer literacy</option>
                    <option value="Skills management">Skills management</option>
                    <option value="Initiative">Initiative</option>
                    <option value="Management">Management</option>
                    <option value="Resilience">Resilience</option>
                    <option value="Decision-making">Decision-making</option>
                    <option value="Active listening">Active listening</option>
                    <option value="Confidence">Confidence</option>
                    <option value="Data analysis">Data analysis</option>
                    <option value="Organization">Organization</option>
                    <option value="Professionalism">Professionalism</option>
                    <option value="Communication">Communication</option>
                    <option value="Collaboration">Collaboration</option>
                    <option value="Leadership skills">Leadership skills</option>
                    <option value="Organisational skills">Organisational skills</option>
                `;
                const removeBtn = document.createElement('button');
                removeBtn.type = 'button';
                removeBtn.classList.add('btn', 'btn-danger', 'remove-skill-btn');
                removeBtn.textContent = 'Remove';
                removeBtn.addEventListener('click', () => {
                    skillGroup.remove();
                });

                skillGroup.appendChild(select);
                skillGroup.appendChild(removeBtn);
                skillsContainer.appendChild(skillGroup);
            });

            // Handle removing skill
            skillsContainer.addEventListener('click', (e) => {
                if (e.target.classList.contains('remove-skill-btn')) {
                    e.target.closest('.skill-group').remove();
                }
            });
        </script>
    </body>
</html>
