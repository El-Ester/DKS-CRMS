<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\Controller;
use App\Http\Controllers\Auth\CandidateAuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\position\positionController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\trainee\traineeController;
use App\Http\Controllers\UuidController;
use App\Http\Controllers\VacationController;
use App\Http\Controllers\ModeratorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HiringController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JPPSTMHiringController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\FrontpageController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\ManageCandidatesController;
use App\Http\Controllers\PersonalDetailController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\RefereeController;
use App\Http\Controllers\EmploymentController;
use App\Http\Controllers\CandidatePictureController;
use App\Http\Controllers\PreviousEmploymentsController;
use App\Http\Controllers\CurrentEmploymentController;
use App\Http\Controllers\FamilyDetailsController;
use App\Http\Controllers\SchoolQualificationsController;
use App\Http\Controllers\HigherEducationQualificationsController;

Route::get('/', function () {
    return view('frontpage.frontpage');
});

Route::get('/jobs', [JobController::class, 'index']);
// Define the route for viewing job details//
Route::get('/job/{id}', [JobController::class, 'show'])->name('frontpage.job-details');

//----------------------------User with Role Login----------------------------//
// Show the login form
Route::get('login', [LoginController::class, 'index'])->name('login');
// Handle login submission
Route::post('login', [LoginController::class, 'auth'])->name('login.submit');
// Handle logout
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
// Dashboard (protected by auth middleware)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('candidate.dashboard');
});

//----------------------------------------APPLICANT LOGIN AND REGISTER---------------------------------------//
// Show applicant registration form
Route::get('/register', [CandidateAuthController::class, 'showRegisterForm'])->name('candidate.register');
// Handle applicant registration submission
Route::post('/register', [CandidateAuthController::class, 'register']);
// Show applicant login form
Route::get('/candidate/login', [CandidateAuthController::class, 'showLoginForm'])->name('candidate.login');
// Handle applicant login submission
Route::post('/candidate/login', [CandidateAuthController::class, 'login']);
// Applicant logout
Route::post('/candidate/logout', [CandidateAuthController::class, 'logout'])->name('candidate.logout');

//---------------------------------------Front Page Portal------------------------------------------------//
// Route for the home page pointing to the FrontpageController@index
Route::get('/', [FrontpageController::class, 'index'])->name('frontpage.frontpage');

// Optional: If you need a named route for /frontpage that points to the same controller action
Route::get('/frontpage', [FrontpageController::class, 'index'])->name('frontpage.frontpage');


//---------------------------------------Front Page Portal------------------------------------------------//
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'auth'])->name('auth');


//---------------PERSONAL DETAILS ROUTE-----------------//
Route::middleware('auth:candidate')->group(function () {
    Route::get('/personal-details/create', [PersonalDetailController::class, 'create'])->name('personal_details.create');
    Route::post('/personal-details', [PersonalDetailController::class, 'store'])->name('personal_details.store');
});

//--------------- TRAINING ROUTE ----------------------//
Route::get('/training', [TrainingController::class, 'showForm'])->name('training.form');
Route::post('/training/store', [TrainingController::class, 'store'])->name('training.store');
Route::put('/training/update/{id}', [TrainingController::class, 'update'])->name('training.update');
Route::delete('/training/destroy/{id}', [TrainingController::class, 'destroy'])->name('training.destroy');


//---------------------REFEREE ROUTE ---------------------//

// Route to show the referee form
Route::get('/referee', [RefereeController::class, 'showForm'])->name('referee.form');
Route::post('/referee', [RefereeController::class, 'store'])->name('referee.store');
Route::put('/referee/update/{id}', [RefereeController::class, 'update'])->name('referee.update');
Route::delete('/referee/destroy/{id}', [RefereeController::class, 'destroy'])->name('referee.destroy');

//-------------------------EMPLOYMENT ROUTE-----------------------//
Route::get('employment/form', [PreviousEmploymentsController::class, 'showForm'])->name('employment.form');
Route::post('previous-employments/store', [PreviousEmploymentsController::class, 'store'])->name('previous-employments.store');
Route::put('previous-employments/update/{id}', [PreviousEmploymentsController::class, 'update'])->name('previous-employments.update');
Route::delete('previous-employments/destroy/{id}', [PreviousEmploymentsController::class, 'destroy'])->name('previous-employments.destroy');

Route::post('current-employment/store', [CurrentEmploymentController::class, 'store'])->name('current-employment.store');
Route::put('current-employment/update/{id}', [CurrentEmploymentController::class, 'update'])->name('current-employment.update');
Route::delete('current-employment/destroy/{id}', [CurrentEmploymentController::class, 'destroy'])->name('current-employment.destroy');

//-----------------------FAMILT DETAILS ROUTE-----------------------//
Route::get('family-details/form', [FamilyDetailsController::class, 'showForm'])->name('family-details.form');
Route::post('family-details/store', [FamilyDetailsController::class, 'store'])->name('family-details.store');
Route::put('/family-details/update/{id}', [FamilyDetailsController::class, 'update'])->name('family-details.update');
Route::delete('/family-details/destroy/{id}', [FamilyDetailsController::class, 'destroy'])->name('family-details.destroy');

//--------------------------- Job APPLICATION Routes ----------------------------//
Route::middleware(['auth:candidate'])->group(function () {
    // Route::get('jobs', [JobController::class, 'showJobs'])->name('jobs.index');
    // // Route::post('jobs/{jobId}/apply', [JobController::class, 'applyForJob'])->name('jobs.apply');
    // Route::post('/jobs/apply', [JobApplicationController::class, 'apply'])->name('jobs.apply');
});
Route::get('/jobs', [JobApplicationController::class, 'index'])->name('jobs.index');
Route::post('/apply', [JobApplicationController::class, 'apply'])->name('jobs.apply');


//--------------------------Applicant Dashboard-----------------------------//
Route::get('/candidate/dashboard', function () {
    return view('candidate.dashboard');
})->middleware('candidate');

Route::get('/candidate/profile', [CandidateController::class, 'profile'])->name('candidate.profile')->middleware('candidate');
Route::get('/candidate/applications', [CandidateController::class, 'applications'])->name('candidate.applications')->middleware('candidate');
Route::get('/candidate/settings', [CandidateController::class, 'settings'])->name('candidate.settings')->middleware('candidate');

Route::middleware(['candidate'])->group(function () {
    Route::get('/candidate/dashboard', [CandidateController::class, 'dashboard'])->name('candidate.dashboard');
});

//--Route fro jobApplication--//
//Route::get('/candidate/job-application', [CandidateController::class, 'jobApplication'])->name('candidate.jobApplication');


//------------------------------------------APPLY JOB--------------------------------------------------//
Route::middleware(['auth:candidate'])->group(function () {
    // Show available jobs and applied jobs
    Route::get('/candidate/jobs', [JobApplicationController::class, 'index'])->name('candidate.jobApplicationPage');

    // Show the details of a job
    Route::get('/candidate/job/{jobId}', [JobApplicationController::class, 'jobDetails'])->name('candidate.job.details');

    // Apply for a job (show confirmation)
    // Route::get('/candidate/job/{jobId}/apply', [JobApplicationController::class, 'confirmApplication'])->name('candidate.job.apply');
    Route::get('/job-applications/apply/{jobId}', [JobApplicationController::class, 'apply']);

    // Store the application after confirmation
    Route::post('/candidate/job/{jobId}/store-application', [JobApplicationController::class, 'storeApplication'])->name('candidate.job.storeApplication');

    // View the list of jobs the candidate has applied to
    Route::get('/candidate/applied-jobs', [JobApplicationController::class, 'appliedJobs'])->name('candidate.appliedJobs');

    Route::get('/applied-jobs', [JobApplicationController::class, 'showAppliedJobs']);
    Route::delete('/job-application/{id}', [JobApplicationController::class, 'destroy'])->name('jobApplication.destroy');

});


// Route for displaying the apply job form
Route::get('/job-apply/{id}', function ($id) {
    $job = App\Models\Job::find($id);
    return view('candidate.job-apply', compact('job'));
})->name('candidate.job.apply');

// Route for handling the job application submission
Route::post('/job-apply/{id}/submit', [App\Http\Controllers\CandidateController::class, 'applySubmit'])
    ->name('candidates.apply.submit');

//------------------------------------------------APPLY JOB------------------------------------------------//



// HRD Dashboard and JPPSTM Dashboard
Route::get('/hrd-dashboard', function () {
    return view('dashboards.hrd');
})->name('hrd.dashboard');

Route::get('/jppstm-dashboard', function () {
    return view('dashboards.jppstm');
})->name('jppstm.dashboard');

Route::get('/hrd-dashboard', [DashboardController::class, 'hrd'])->name('hrd.dashboard');
Route::get('/jppstm-dashboard', [DashboardController::class, 'jppstm'])->name('jppstm.dashboard');

// HRD Dashboard (Authenticated route)
Route::middleware(['auth', 'role:hrd'])->get('hrd/dashboard', [DashboardController::class, 'hrdDashboard'])->name('hrd.dashboard');

// JPPSTM Dashboard (Authenticated route)
Route::middleware(['auth', 'role:jppstm'])->get('jppstm/dashboard', [DashboardController::class, 'jppstmDashboard'])->name('jppstm.dashboard');

// Applicant Dashboard (Authenticated route)
Route::middleware(['auth', 'role:applicant'])->get('applicant/dashboard', [DashboardController::class, 'applicantDashboard'])->name('applicant.dashboard');

// Faculty/Centre Dashboard (Authenticated route)
Route::middleware(['auth', 'role:faculty/centre'])->get('faculty/dashboard', [DashboardController::class, 'facultyCentreDashboard'])->name('facultyCentre.dashboard');

// Department/Unit Dashboard (Authenticated route)
Route::middleware(['auth', 'role:department/unit'])->get('department/dashboard', [DashboardController::class, 'departmentUnitDashboard'])->name('departmentUnit.dashboard');

// Board Members Dashboard (Authenticated route)
Route::middleware(['auth', 'role:board members'])->get('board/dashboard', [DashboardController::class, 'boardMembersDashboard'])->name('boardMembers.dashboard');

// Assistant Registrar Dashboard (Authenticated route)
Route::middleware(['auth', 'role:assistant registrar'])->get('assistant-registrar/dashboard', [DashboardController::class, 'assistantRegistrarDashboard'])->name('assistant.registrar.dashboard');

//-------------------------------------Hiring Management for HRD-----------------------------------//
Route::prefix('hrd/manage-hiring')->name('hrd.manage_hiring.')->group(function () {
    Route::get('/', [HiringController::class, 'index'])->name('index');
    Route::get('/create', [HiringController::class, 'create'])->name('create');
    Route::post('/', [HiringController::class, 'store'])->name('store');
    Route::get('/view/{job}', [HiringController::class, 'view'])->name('view');
    Route::get('/{job}/edit', [HiringController::class, 'edit'])->name('edit');
    Route::put('/{job}', [HiringController::class, 'update'])->name('update');
    Route::delete('/{job}', [HiringController::class, 'destroy'])->name('destroy');
    Route::get('/{job}/candidates', [HiringController::class, 'manageCandidates'])->name('candidates');
});

//-------------------------------------Hiring Management for JPPSTM-----------------------------------//
Route::prefix('jppstm/manage-hiring')->name('jppstm.manage_hiring.')->group(function () {
    Route::get('/', [JPPSTMHiringController::class, 'index'])->name('index');
    Route::get('/create', [JPPSTMHiringController::class, 'create'])->name('create');
    Route::post('/', [JPPSTMHiringController::class, 'store'])->name('store');
    Route::get('/view/{job}', [JPPSTMHiringController::class, 'view'])->name('view');
    Route::get('/{job}/edit', [JPPSTMHiringController::class, 'edit'])->name('edit');
    Route::delete('/{job}', [JPPSTMHiringController::class, 'destroy'])->name('destroy');
    Route::get('/{job}/candidates', [JPPSTMHiringController::class, 'manageCandidates'])->name('candidates');
});

//-------------------------------------Shared Update Route------------------------------------------//
Route::put('/hiring/{id}', [HiringController::class, 'update'])->name('hiring.update');

//-------------------------------MANAGE CANDIDATES------------------------------------//
Route::get('/job/{job}/manage-candidates', [HiringController::class, 'manageCandidates'])->name('hrd.manage_hiring.candidates');

// HRD Employee Management
Route::middleware(['auth', 'role:hrd'])->get('hrd/manage-employees', [EmployeeController::class, 'index'])->name('hrd.manage_employees.index');

Route::get('/hrd/manage-candidates', [CandidateController::class, 'index'])->name('hrd.manage_candidates.index');

//------------HOME----------HOME--------------HOME---------------HOME//
Route::view('/office-human-resources', 'frontpage.frontpage')->name('frontpage.frontpage');

Route::get('/office-human-resources', [FrontpageController::class, 'showHumanResources'])->name('frontpage.frontpage');

Route::get('/jobs/{filter?}', [FrontpageController::class, 'jobsIndex'])->name('frontpage.jobs.index');
Route::get('/job-details/{id}', [FrontpageController::class, 'jobDetails'])->name('frontpage.job.details');
Route::get('/', [FrontpageController::class, 'index'])->name('frontpage.index');

// Guest Routes
Route::middleware(['guest'])->group(function () {
    Route::redirect('/', '/home', 301); // Ensure this points to the front page
    Route::get('/support', function () {
        return view("support", ["title" => "Support"]);
    });

});


// Error Handling Routes
Route::prefix("error")->group(function () {
    Route::get("/500", function () {
        return view("error.500");
    })->name("500");
    Route::get("/admin-not-active", function () {
        return view("error.admin_notActive");
    })->name("notActive");
});


Route::get('/frontpage/{filter?}', [FrontpageController::class, 'jobsIndex'])->name('frontpage.index');

Route::get('/jobs', [FrontpageController::class, 'jobsIndex'])->name('frontpage.index');
Route::get('/', [FrontpageController::class, 'index'])->name('frontpage.index');

// Define the route for job details
Route::get('/candidate/job', [CandidateController::class, 'jobDetails'])->name('candidate.job-details');
Route::get('/candidate/applicant-info/{id}', [CandidateController::class, 'showApplicantInfo'])->name('candidate.applicantInfo');
Route::post('/candidate/apply/{id}', [CandidateController::class, 'submitApplication'])->name('candidate.submitApplication');


//-------------------------------------------MANAGE CANDIDATES ROUTE---------------------------------------------------//
Route::get('/job/{jobId}/candidates', [ManageCandidatesController::class, 'manageCandidates'])->name('hrd.manage_candidates.index');
Route::get('/candidates/{id}', [ManageCandidatesController::class, 'view'])->name('hrd.manage_candidates.view');

Route::put('/manage-candidates/update-status', [ManageCandidatesController::class, 'updateStatus'])->name('hrd.manage_candidates.update_status');
Route::get('/job/{jobId}/candidates', [ManageCandidatesController::class, 'index'])->name('hrd.manage_candidates.index');

Route::get('/job/{jobId}/candidates', [ManageCandidatesController::class, 'index'])->name('hrd.manage_candidates.index');

Route::put('/job-applications/{applicationId}/status', [ManageCandidatesController::class, 'updateApplicationStatus'])
     ->name('hrd.update_application_status');

     // Define the route for rejecting an application
     Route::get('/hrd/manage_candidates/rejected/{jobId}', [ManageCandidatesController::class, 'showRejected'])
     ->name('hrd.manage_candidates.rejected');

Route::put('/manage-hiring/{id}', [HiringController::class, 'update'])->name('hrd.manage_hiring.update');

Route::get('candidate/applicant-info/{id?}', [CandidateController::class, 'show'])->name('candidate.applicantInfo');



// Middleware ensures only authenticated candidates can access these routes
Route::middleware(['auth:candidate'])->group(function () {
    Route::post('/apply-job', [CandidateController::class, 'applyJob'])->name('candidate.applyJob');
    Route::get('/applied-jobs', [CandidateController::class, 'viewAppliedJobs'])->name('candidate.applied_jobs');
});



Route::middleware(['auth:candidate'])->group(function () {
    Route::get('/candidate/job-details', [JobController::class, 'jobDetails'])->name('candidate.job-details');
});

Route::post('/candidate/apply/{jobId}', [JobController::class, 'apply'])->name('candidate.apply');
Route::get('/jobs/{job}/view', [JobController::class, 'view'])->name('jobs.view');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth:candidate'])->group(function () {
    Route::get('jobs', [JobApplicationController::class, 'index'])->name('jobs.index');
});

// Route::get('jobs', [JobController::class, 'showJobs'])->name('jobs.index');

//------------Picture Upload Route--------------------//
Route::get('/upload-picture', [CandidatePictureController::class, 'index'])->middleware('auth:candidate')->name('upload.picture');
Route::post('/upload-picture', [CandidatePictureController::class, 'upload'])->middleware('auth:candidate');
Route::post('/remove-picture', [CandidatePictureController::class, 'remove'])->name('remove.picture');
Route::post('/upload-picture', [CandidatePictureController::class, 'uploadPicture']);



//----------------------------QUALIFICATIONS ROUTE------------------------//
Route::get('school-qualifications/form', [SchoolQualificationsController::class, 'showForm'])->name('school-qualifications.form');
Route::post('school-qualifications/store', [SchoolQualificationsController::class, 'store'])->name('school-qualifications.store');
Route::put('/school-qualifications/update/{id}', [SchoolQualificationsController::class, 'update'])->name('school-qualifications.update');
Route::delete('/school-qualifications/destroy/{id}', [SchoolQualificationsController::class, 'destroy'])->name('school-qualifications.destroy');

Route::get('higher-qualifications/form', [HigherEducationQualificationsController::class, 'showForm'])->name('higher-qualifications.form');
Route::post('higher-qualifications/store', [HigherEducationQualificationsController::class, 'store'])->name('higher-qualifications.store');
Route::put('/higher-qualifications/update/{id}', [HigherEducationQualificationsController::class, 'update'])->name('higher-qualifications.update');
Route::delete('/higher-qualifications/destroy/{id}', [HigherEducationQualificationsController::class, 'destroy'])->name('higher-qualifications.destroy');
