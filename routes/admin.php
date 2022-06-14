
<?php

use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Admin\Appointments\CreateAppointmentForm;
use App\Http\Livewire\Admin\Appointments\ListAppointments;
use App\Http\Livewire\Admin\Appointments\UpdateAppointmentForm;
use App\Http\Livewire\Admin\Profile\UpdateProfile;
use App\Http\Livewire\Admin\User\ListUsers;
use Illuminate\Support\Facades\Route;

// befor config RouteServiceProvider.php
// Route::group(['middleware' => ['auth', 'admin']], function () {

//     Route::get('admin/dashboard', [DashboardController::class, 'home'])->name('admin.dashboard.home');

//     Route::get('admin/users', ListUsers::class)->name('admin.users');

//     Route::get('admin/appointments', ListAppointments::class)->name('admin.apointments');

//     Route::get('admin/appointments/create', CreateAppointmentForm::class)->name('admin.appointments.create');
//     Route::get('admin/appointments/{appointment}/edit', UpdateAppointmentForm::class)->name('admin.appointments.edit');
// });

// After config RouteServiceProvider.php

Route::get('dashboard', [DashboardController::class, 'home'])->name('dashboard.home');

Route::get('users', ListUsers::class)->name('users');

Route::get('appointments', ListAppointments::class)->name('apointments');

Route::get('appointments/create', CreateAppointmentForm::class)->name('appointments.create');

Route::get('appointments/{appointment}/edit', UpdateAppointmentForm::class)->name('appointments.edit');

Route::get('profile', UpdateProfile::class)->name('profile.edit');

