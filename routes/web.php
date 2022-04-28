<?php

use App\Http\Controllers\DashboardController;
use App\Http\Livewire\Admin\Appointments\CreateAppointmentForm;
use App\Http\Livewire\Admin\Appointments\ListAppointments;
use App\Http\Livewire\Admin\User\ListUsers;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/dashboard', [DashboardController::class,'home'] )->name('admin.dashboard.home');

Route::get('admin/users',ListUsers::class)->name('admin.users');

Route::get('admin/appointments',ListAppointments::class)->name('admin.apointments');

Route::get('admin/appointments/create',CreateAppointmentForm::class)->name('admin.appointments.create');