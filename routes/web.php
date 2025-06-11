<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\EngineerController;

// Redirect root to login
Route::get('/', fn () => redirect()->route('login'));
Route::get('/login', fn () => view('auth.login'))->name('login');

// Authentication
Route::post('/login', [LoginController::class, 'auth'])->name('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Authenticated Routes
Route::middleware(['auth'])->group(function () {

    // Dashboard Routes
    Route::get('/systemAdmin/dashboard', [AdminController::class, 'index'])->name('systemAdmin.dashboard');
    Route::get('/DKSstaff/dashboard', [StaffController::class, 'index'])->name('DKSstaff.dashboard');
    Route::get('/serviceEngineer/dashboard', [EngineerController::class, 'index'])->name('serviceEngineer.dashboard');

    // Profile Routes
    Route::middleware(['auth', 'role:1'])->get('/profileAdmin/show', [ProfileController::class, 'showAdmin'])->name('profileAdmin.show');
    Route::middleware(['auth', 'role:1'])->get('/profileAdmin/edit', [ProfileController::class, 'updatePassword'])->name('profileAdmin.edit');
    Route::middleware(['auth', 'role:2'])->get('/profileStaff/show', [ProfileController::class, 'showStaff'])->name('profileStaff.show');
    Route::middleware(['auth', 'role:2'])->get('/profileStaff/edit', [ProfileController::class, 'updatePassword'])->name('profileStaff.edit');
    Route::middleware(['auth', 'role:3'])->get('/profileEngineer/show', [ProfileController::class, 'showEngineer'])->name('profileEngineer.show');
    Route::middleware(['auth', 'role:3'])->get('/profileEngineer/edit', [ProfileController::class, 'updatePassword'])->name('profileEngineer.edit');


    // Forgot Password (shared for all roles)
    Route::post('/forgot-password', function (Request $request) {
        $request->validate(['user_email' => 'required|email']);
        $status = Password::sendResetLink($request->only('user_email'));
        return back()->with('status', __($status));
    })->name('password.email');

    // Case Routes by Role
// Protect admin-specific routes
Route::middleware('role:1')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('statuses', StatusController::class);

    // Admin view to add new case
    Route::get('/systemAdmin/addNewCase', [CaseController::class, 'create'])->name('systemAdmin.addNewCase');
});

// Staff create case form
Route::middleware('role:2')->group(function () {
    Route::get('/DKSstaff/addNewCase', [CaseController::class, 'create'])->name('DKSstaff.addNewCase');
    Route::post('/cases', [CaseController::class, 'store'])->name('cases.store');
    Route::put('/cases/{id}', [CaseController::class, 'update'])->name('cases.update');
});

// Engineer create case form
Route::middleware('role:3')->group(function () {
    Route::get('/serviceEngineer/addNewCase', [CaseController::class, 'create'])->name('serviceEngineer.addNewCase');
    Route::post('/cases', [CaseController::class, 'store'])->name('cases.store');

});

// 🔐 All CaseController routes accessible to Admin, Staff, Engineer
Route::middleware('role:1,2,3')->group(function () {
    Route::get('/cases', [CaseController::class, 'index'])->name('cases.index');
    Route::post('/cases', [CaseController::class, 'store'])->name('cases.store');
    Route::get('/cases/{id}', [CaseController::class, 'show'])->name('cases.show');
    Route::get('/cases/{id}/edit', [CaseController::class, 'edit'])->name('cases.edit');
    Route::put('/cases/{id}', [CaseController::class, 'update'])->name('cases.update');
    Route::delete('/cases/{id}', [CaseController::class, 'destroy'])->name('cases.destroy');
    Route::get('/cases/{id}/pdf', [CaseController::class, 'generatePDF'])->name('case.pdf');
});
});

/// FOR USER & ROLE MANAGEMENT : ADMIN ///
Route::get('/systemAdmin/userManagement', [UserController::class, 'index'])->name('systemAdmin.userManagement');
Route::get('/systemAdmin/createNewUser', [UserController::class, 'create'])->name('systemAdmin.createNewUser');

Route::get('/systemAdmin/roleManagement', [RoleController::class, 'index'])->name('systemAdmin.roleManagement');
Route::get('/systemAdmin/createNewRole', [RoleController::class, 'create'])->name('systemAdmin.createNewRole');
Route::post('/systemAdmin/roles', [RoleController::class, 'store'])->name('systemAdmin.storeRole');
Route::delete('/systemAdmin/roles/{role}', [RoleController::class, 'destroy'])->name('role.destroy');


//FOR STATYS MANAGEMENT ///
Route::get('/systemAdmin/Status', [StatusController::class, 'index'])->name('systemAdmin.Status');
///FOR GENERATING PDF REPORTS///
Route::get('/systemAdmin/cases/{id}/generate-case-report', [CaseController::class, 'generateCaseReport'])->name('cases.generateCaseReport');
Route::get('/systemAdmin/cases/{id}/generate-final-diagnostic-report', [CaseController::class, 'generateFinalDiagnosticReport'])->name('cases.generateFinalDiagnosticReport');


// Fallback route
Route::fallback(fn () => response()->view('error.404', [], 404));
