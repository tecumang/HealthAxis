<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\patientcontoller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\FranchiseLoginController;
use App\Http\Controllers\Auth\PatientLoginController;
use App\Http\Controllers\FranchiseController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('dashboard');
// });

Route::get('/', [LandingPageController::class, 'index'])->name('index');
Route::get('/Login/Patient', [LandingPageController::class, 'patientlogin'])->name('patient-login');
Route::get('/Login/Franchise', [LandingPageController::class, 'franchiselogin'])->name('franchise-login');
Route::get('/Login/Admin', [LandingPageController::class, 'adminlogin'])->name('admin-login');
Route::get('/Registration', [LandingPageController::class, 'patientregister'])->name('patient-registration');
Route::post('/register/patient', [LandingPageController::class, 'register'])->name('patients.store');
Route::post('/query', [LandingPageController::class, 'store'])->name('query.store');



// Admin Routes
Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin-logins');
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin-logout');

Route::middleware('role:admin')->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/dashboard/Franchise', [AdminController::class, 'franchise'])->name('admin.franchise');
    Route::get('/admin/dashboard/Add/Franchise', [AdminController::class, 'addfranchise'])->name('admin.addfranchise');
    Route::post('/admin/dashboard/Adding/Franchise', [AdminController::class, 'franchisestore'])->name('admin.franchise.store');
    Route::get('/admin/franchise/edit/{id}', [AdminController::class, 'editfranchise'])->name('admin.franchise.edit');
    Route::put('/admin/franchise/update/{id}', [AdminController::class, 'updatefranchise'])->name('admin.franchise.update');
    Route::delete('/admin/franchise/delete/{id}', [AdminController::class, 'deletefranchise'])->name('admin.franchise.delete');
    Route::get('/admin/dashboard/Patients', [AdminController::class, 'patient'])->name('admin.patients');
    Route::get('/admin/dashboard/Add/Patients', [AdminController::class, 'addpatients'])->name('admin.addpatients');
    Route::post('/admin/dashboard/Adding/Patients', [AdminController::class, 'patientstore'])->name('admin.Patient.store');
    Route::get('/admin/patients/edit/{id}', [AdminController::class, 'editpatient'])->name('admin.patient.edit');
    Route::put('/admin/patients/update/{id}', [AdminController::class, 'updatepatient'])->name('admin.patient.update');
    Route::delete('/admin/patients/delete/{id}', [AdminController::class, 'deletePatient'])->name('admin.patients.delete');
    Route::get('/admin/dashboard/Queries', [AdminController::class, 'query'])->name('admin.query');
    Route::get('/admin/dashboard/Test', [AdminController::class, 'test'])->name('admin.test');
    Route::get('/admin/dashboard/Appointment/Details', [AdminController::class, 'appointment'])->name('admin.appoinment');
    Route::get('/admin/dashboard/Transactions/Details', [AdminController::class, 'payment'])->name('admin.payment');
    Route::get('/admin/dashboard/Testimonials', [AdminController::class, 'addtestimonial'])->name('admin.testimonials.add');
    Route::post('/admin/testimonials/store', [AdminController::class, 'storetestimonial'])->name('admin.testimonials.store');
    Route::get('/admin/dashboard/testimonials', [AdminController::class, 'testimonial'])->name('admin.testmonial');
    Route::get('/admin/testimonials/edit/{id}', [AdminController::class, 'edittestimonial'])->name('admin.testimonial.edit');
    Route::put('/admin/testimonials/update/{id}', [AdminController::class, 'updatetestimonial'])->name('admin.testimonial.update');
    Route::delete('/admin/testimonials/delete/{id}', [AdminController::class, 'deletetestimonial'])->name('admin.testimonials.delete');
   
});

// Franchise Routes
Route::post('/franchise/login', [FranchiseLoginController::class, 'login'])->name('franchise-logins');
Route::get('/franchise/logout', [FranchiseLoginController::class, 'logout'])->name('franchise-logout');

Route::middleware('role:franchise')->group(function () {

    Route::get('/franchise/dashboard', [FranchiseController::class, 'dashboard'])->name('franchise.dashboard');
    Route::get('/Franchise/dashboard/Test', [FranchiseController::class, 'test'])->name('franchise.test');
    Route::get('/Franchise/dashboard/Add/Test', [FranchiseController::class, 'addtest'])->name('franchise.add.test');
    Route::post('/Franchise/test/store', [FranchiseController::class, 'storeFranchiseTest'])->name('franchise.test.store');
    Route::get('/Franchise/test/edit/{id}', [FranchiseController::class, 'edittest'])->name('franchise.test.edit');
    Route::put('/Franchise/test/update/{id}', [FranchiseController::class, 'updatetest'])->name('franchise.test.update');
    Route::delete('/Franchise/test/delete/{id}', [FranchiseController::class, 'deletetest'])->name('franchise.test.delete');
    Route::get('/Franchise/dashboard/Appointment', [FranchiseController::class, 'appoint'])->name('franchise.appoint');
    Route::put('/Franchise/appointments/{id}/status', [FranchiseController::class, 'updateStatus'])->name('appointments.updateStatus');
    Route::get('/Franchise/dashboard/pendng/Appointment', [FranchiseController::class, 'pendingappoint'])->name('franchise.pending.appoint');
    Route::get('/Franchise/dashboard/Completed/Appointment', [FranchiseController::class, 'completeappoint'])->name('franchise.completed.appoint');
    Route::get('/Franchise/dashboard/Cancelled/Appointment', [FranchiseController::class, 'cancelledappoint'])->name('franchise.cancelled.appoint');
    Route::get('/Franchise/dashboard/Transaction', [FranchiseController::class, 'transaction'])->name('franchise.transaction');
    Route::get('/franchise/profile', [FranchiseController::class, 'profile'])->name('franchise.profile');
    Route::post('/franchise/profile/upload-template', [FranchiseController::class, 'uploadTemplate'])->name('franchise.upload.template');
    Route::put('/Franchise/profile/update/{id}', [FranchiseController::class, 'updateProfile'])->name('franchise.update.profile');
    Route::get('/franchise/Report', [FranchiseController::class, 'report'])->name('franchise.report');
    Route::get('/franchise/Patient/{id}', [FranchiseController::class, 'franchisePatients'])->name('franchise.patient.show');
    Route::post('/franchise/reports/store', [FranchiseController::class, 'reportsstore'])->name('franchise.report.store');
    Route::get('/franchise/report/edit/{report}', [FranchiseController::class, 'editreport'])->name('franchise.report.edit');
    Route::put('/franchise/report/update/{report}', [FranchiseController::class, 'updatereport'])->name('franchise.update.parameter');
    Route::delete('/franchise/report/delete-test/{id}', [FranchiseController::class, 'deleteTestresult'])->name('franchise.report.delete-test');
    Route::get('/franchise/report/view/{appointment}', [FranchiseController::class, 'viewReport'])->name('franchise.report.view');
    Route::get('/franchise/dashboard/Add/Patients', [FranchiseController::class, 'addpatients'])->name('franchise.addpatients');
    Route::post('/franchise/dashboard/Adding/Patients', [FranchiseController::class, 'patientstore'])->name('franchise.Patient.store');
    Route::get('/franchise/report/download/{appointment}', [FranchiseController::class, 'downloadReport'])->name('franchise.report.download');

});

// Patient Routes
Route::post('/patient/login', [PatientLoginController::class, 'login'])->name('patients-login');
Route::get('/patient/logout', [PatientLoginController::class, 'logout'])->name('patient-logout');

Route::middleware('role:patients')->group(function () {
    Route::get('/patient/dashboard', [patientcontoller::class, 'index'])->name('patient.dashboard');
    Route::get('/patient/pathology', [patientcontoller::class, 'pathlab'])->name('patient.Pathlab');
    Route::get('/patient/{id}/tests', [patientcontoller::class, 'showFranchiseTests'])->name('pathlab.tests');
    Route::post('/patient/book-test', [patientcontoller::class, 'bookTest'])->name('book.test');
    Route::get('/patient/payment/{payment_id}', [patientcontoller::class, 'startPayment'])->name('start.payment');
    Route::post('/patient/payment/confirm/{payment_id}', [patientcontoller::class, 'confirmPayment'])->name('confirm.payment');
    Route::get('/patient/dashboard/Upcoming/Tests', [patientcontoller::class, 'upcomingtest'])->name('patient.upcoming.test');
    Route::delete('/patient/Upcoming/test/delete/{id}', [patientcontoller::class, 'deletetest'])->name('patient.upcomingtest.delete');
    Route::put('/appointments/reschedule/{id}', [patientcontoller::class, 'reschedule'])->name('appointment.reschedule');
    Route::get('/patient/pathlabs/Search', [patientcontoller::class, 'pathlabsearh'])->name('patient.pathlab');
    Route::get('/patient/dashboard/Tests/History', [patientcontoller::class, 'testhistory'])->name('patient.history.test');
    Route::get('/patient/dashboard/Profile', [patientcontoller::class, 'profile'])->name('patient.profile');
    Route::put('/patient/dashboard/Profile/update/{id}', [patientcontoller::class, 'updateprofile'])->name('patient.profile.update');
    Route::post('/patient/change-password', [patientcontoller::class, 'changePassword'])->name('patient.change.password');
    Route::get('/patient/dashboard/Trasaction', [patientcontoller::class, 'transactionHistory'])->name('patient.payment');
    Route::get('/patient/report/view/{appointmentId}', [patientcontoller::class, 'viewReport'])->name('patient.report.view');
    Route::get('/report/download/{appointmentId}', [patientcontoller::class, 'downloadReport'])->name('download.report');

    
});




require __DIR__ . '/auth.php';
