<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Frontend\FrontendController;

//admin
use App\Http\Controllers\Admin\BackendController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AsistenteController;
use App\Http\Controllers\Admin\PacienteController;
use App\Http\Controllers\Admin\ClinicaController;
use App\Http\Controllers\Admin\CitaController;
use App\Http\Controllers\Admin\ConfigController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [FrontendController::class, 'index']);
Route::get('about-us', [FrontendController::class, 'aboutus']);
Route::get('contact', [FrontendController::class, 'contact']);
Route::get('send-contact-email', [FrontendController::class, 'sendcontactemail']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard',[BackendController::class, 'index']);

    //Admin Users
    Route::get('users', [DashboardController::class, 'users']);
    Route::get('show-user/{id}', [DashboardController::class, 'showuser']);
    Route::get('add-user', [DashboardController::class, 'adduser']);
    Route::post('insert-user', [DashboardController::class, 'insertuser']);
    Route::get('edit-user/{id}',[DashboardController::class,'edituser']);
    Route::put('update-user/{id}', [DashboardController::class, 'updateuser']);
    Route::get('delete-user/{id}', [DashboardController::class, 'destroyuser']);

    //Assistant Users
    Route::get('asistentes', [AsistenteController::class, 'users']);
    Route::get('show-asistente/{id}', [AsistenteController::class, 'showuser']);
    Route::get('add-asistente', [AsistenteController::class, 'adduser']);
    Route::post('insert-asistente', [AsistenteController::class, 'insertuser']);
    Route::get('edit-asistente/{id}',[AsistenteController::class,'edituser']);
    Route::put('update-asistente/{id}', [AsistenteController::class, 'updateuser']);
    Route::get('delete-asistente/{id}', [AsistenteController::class, 'destroyuser']);

    //Pacientes
    Route::get('pacientes', [PacienteController::class, 'pacientes']);
    Route::get('show-paciente/{id}', [PacienteController::class, 'show']);
    Route::get('add-paciente', [PacienteController::class, 'add']);
    Route::post('insert-paciente', [PacienteController::class, 'insert']);
    Route::get('edit-paciente/{id}',[PacienteController::class,'edit']);
    Route::put('update-paciente/{id}', [PacienteController::class, 'update']);
    Route::get('delete-paciente/{id}', [PacienteController::class, 'destroy']);

    //Clínicas
    Route::get('clinicas', [ClinicaController::class, 'index']);
    Route::get('show-clinica/{id}', [ClinicaController::class, 'show']);
    Route::get('add-clinica', [ClinicaController::class, 'add']);
    Route::post('insert-clinica',[ClinicaController::class,'insert']);
    Route::get('edit-clinica/{id}',[ClinicaController::class,'edit']);
    Route::put('update-clinica/{id}', [ClinicaController::class, 'update']);
    Route::get('delete-clinica/{id}', [ClinicaController::class, 'destroy']);

    //Citas
    Route::get('citas', [CitaController::class, 'index']);
    Route::get('show-cita/{id}', [CitaController::class, 'show']);
    Route::get('add-cita', [CitaController::class, 'add']);
    Route::post('insert-cita', [CitaController::class, 'insert']);
    Route::get('edit-cita/{id}',[CitaController::class,'edit']);
    Route::put('update-cita/{id}', [CitaController::class, 'update']);
    Route::get('delete-cita/{id}', [CitaController::class, 'destroy']);

    //config
    Route::get('config', [ConfigController::class, 'index']);
    Route::put('update-config', [ConfigController::class, 'update']);
 });

 Route::middleware(['auth', 'isAdmin'])->group(function () {
    //front user
});
