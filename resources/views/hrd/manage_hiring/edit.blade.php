<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Hiring</title>
    <link rel="stylesheet" href="{{ asset('css/hiringEdit.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

@include('components.private.header')
@include('components.private.sidebar')

<body>
        <section class="home-section bg-lightblue">
            <i class='bx bx-menu'></i>

            <div class="container">


                <form action="{{ route('hrd.manage_hiring.update', $job->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Job Title -->
                    <div class="form-group">
                        <label class="text" for="title">Job Title</label>
                        <input type="text" name="title" id="title" value="{{ old('title', $job->title) }}" class="form-control" required>
                    </div>

                    <!-- Job Description -->
                    <div class="form-group">
                        <label class="text" for="description">Job Description</label>
                        <textarea name="description" id="description" class="form-control" required>{{ old('description', $job->description) }}</textarea>
                    </div>

                    <!-- Payment -->
                    <div class="form-group">
                        <label class="text" for="payment_amount">Payment Amount</label>
                        <input type="number" name="payment_amount" id="payment_amount" value="{{ old('payment_amount', $job->payment_amount) }}" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="text" for="payment_type">Payment Type</label>
                        <select name="payment_type" id="payment_type" class="form-control" required>
                            <option value="per_day" {{ $job->payment_type === 'per_day' ? 'selected' : '' }}>/ Day</option>
                            <option value="per_month" {{ $job->payment_type === 'per_month' ? 'selected' : '' }}>/ Month</option>
                            <option value="per_year" {{ $job->payment_type === 'per_year' ? 'selected' : '' }}>/ Year</option>
                        </select>
                    </div>

                    <!-- Working Period -->
                    <div class="form-group">
                        <label class="text" for="working_period">Working Period</label>
                        <input type="text" name="working_period" id="working_period" value="{{ old('working_period', $job->working_period) }}" class="form-control" required placeholder="e.g. 12 months">
                    </div>

                    <div class="form-group">
                        <label class="text" for="education">Education Level Required</label>
                        <input type="text" name="education" id="education" value="{{ old('education', $job->education) }}" class="form-control" required placeholder="e.g. bachelor's degree, master's degree, doctorate degree">
                    </div>

                <!-- Dynamic Skills -->
                <div class="form-group">
                    <label class="text" for="skills">Skills Required</label>
                    <div id="skills-container">
                        @foreach(explode(',', $job->skills) as $skill)
                            <div class="skill-group">
                                <select name="skills[]" class="form-select mb-2">
                                    <option value="Problem solving" {{ $skill === 'Problem solving' ? 'selected' : '' }}>Problem solving</option>
                                    <option value="Teamwork" {{ $skill === 'Teamwork' ? 'selected' : '' }}>Teamwork</option>
                                    <option value="Leadership" {{ $skill === 'Leadership' ? 'selected' : '' }}>Leadership</option>
                                    <option value="Creativity" {{ $skill === 'Creativity' ? 'selected' : '' }}>Creativity</option>
                                    <option value="Time management" {{ $skill === 'Time management' ? 'selected' : '' }}>Time management</option>
                                    <option value="Adaptability" {{ $skill === 'Adaptability' ? 'selected' : '' }}>Adaptability</option>
                                    <option value="Critical thinking" {{ $skill === 'Critical thinking' ? 'selected' : '' }}>Critical thinking</option>
                                    <option value="Emotional intelligence" {{ $skill === 'Emotional intelligence' ? 'selected' : '' }}>Emotional intelligence</option>
                                    <option value="Interpersonal communication" {{ $skill === 'Interpersonal communication' ? 'selected' : '' }}>Interpersonal communication</option>
                                    <option value="Computer literacy" {{ $skill === 'Computer literacy' ? 'selected' : '' }}>Computer literacy</option>
                                    <option value="Skills management" {{ $skill === 'Skills management' ? 'selected' : '' }}>Skills management</option>
                                    <option value="Initiative" {{ $skill === 'Initiative' ? 'selected' : '' }}>Initiative</option>
                                    <option value="Management" {{ $skill === 'Management' ? 'selected' : '' }}>Management</option>
                                    <option value="Resilience" {{ $skill === 'Resilience' ? 'selected' : '' }}>Resilience</option>
                                    <option value="Decision-making" {{ $skill === 'Decision-making' ? 'selected' : '' }}>Decision-making</option>
                                    <option value="Active listening" {{ $skill === 'Active listening' ? 'selected' : '' }}>Active listening</option>
                                    <option value="Confidence" {{ $skill === 'Confidence' ? 'selected' : '' }}>Confidence</option>
                                    <option value="Data analysis" {{ $skill === 'Data analysis' ? 'selected' : '' }}>Data analysis</option>
                                    <option value="Organization" {{ $skill === 'Organization' ? 'selected' : '' }}>Organization</option>
                                    <option value="Professionalism" {{ $skill === 'Professionalism' ? 'selected' : '' }}>Professionalism</option>
                                    <option value="Communication" {{ $skill === 'Communication' ? 'selected' : '' }}>Communication</option>
                                    <option value="Collaboration" {{ $skill === 'Collaboration' ? 'selected' : '' }}>Collaboration</option>
                                </select>
                                <button type="button" class="btn btn-danger remove-skill-btn">Remove</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" id="add-skill-btn" class="btn btn-primary mb-3">Add Skill</button>
                </div>

                    <div class="form-group">
                        <label class="text" for="experience">Experience Required (in years)</label>
                        <input type="number" name="experience" id="experience" value="{{ old('experience', $job->experience) }}" class="form-control" required placeholder="e.g. 2, 5, 10 years">
                    </div>

                    <div class="form-label">
                        <label for="open-date">Open Date:</label>
                        <input type="date" name="open_date" class="form-control" value="{{ old('open_date', $job->open_date) }}" required>
                    </div>

                    <div class="form-label">
                        <label for="close-date">Close Date:</label>
                        <input type="date" name="close_date" class="form-control" value="{{ old('close_date', $job->close_date) }}" required>
                    </div>

                    <div class="form-label">
                        <label class="text" for="document_required">Document Required</label>
                        <input type="text" name="document_required" id="document_required" value="{{ old('document_required', $job->document_required) }}" class="form-control" required placeholder="Enter documents required, e.g., Cover Letter, Resume, Certifications, etc.">
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label class="text" for="status">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="draft" {{ $job->status === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="open" {{ $job->status === 'open' ? 'selected' : '' }}>Open</option>
                            <option value="closed" {{ $job->status === 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="{{ route('hrd.manage_hiring.index') }}" class="btn btn-secondary">Cancel</a> <!-- Cancel button -->
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
@include('components.private.footer')
