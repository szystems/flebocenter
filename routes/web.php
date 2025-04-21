<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Frontend\FrontendController;

//admin
use App\Http\Controllers\Admin\BackendController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AsistenteController;
use App\Http\Controllers\Admin\PacienteController;
use App\Http\Controllers\Admin\RecetaController;
use App\Http\Controllers\Admin\SeguimientoController;
use App\Http\Controllers\Admin\HistoriaController;
use App\Http\Controllers\Admin\DocumentoController;
use App\Http\Controllers\Admin\TerapiaController;
use App\Http\Controllers\Admin\ClinicaController;
use App\Http\Controllers\Admin\CitaController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ProveedorController;
use App\Http\Controllers\Admin\ArticuloController;
use App\Http\Controllers\Admin\InventarioController;
use App\Http\Controllers\Admin\IngresoController;
use App\Http\Controllers\Admin\PagoIngresoController;
use App\Http\Controllers\Admin\VentaController;
use App\Http\Controllers\Admin\PagoVentaController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\BariatriaController;

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
Route::get('services', [FrontendController::class, 'services']);
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
    Route::get('pdf-doctores', [DashboardController::class, 'pdf']);
    Route::get('pdf-doctor/{id}', [DashboardController::class, 'pdfdoctor']);

    //Assistant Users
    Route::get('asistentes', [AsistenteController::class, 'users']);
    Route::get('show-asistente/{id}', [AsistenteController::class, 'showuser']);
    Route::get('add-asistente', [AsistenteController::class, 'adduser']);
    Route::post('insert-asistente', [AsistenteController::class, 'insertuser']);
    Route::get('edit-asistente/{id}',[AsistenteController::class,'edituser']);
    Route::put('update-asistente/{id}', [AsistenteController::class, 'updateuser']);
    Route::get('delete-asistente/{id}', [AsistenteController::class, 'destroyuser']);
    Route::get('pdf-asistentes', [AsistenteController::class, 'pdf']);
    Route::get('pdf-asistente/{id}', [AsistenteController::class, 'pdfasistente']);

    //Pacientes
    Route::get('pacientes', [PacienteController::class, 'pacientes']);
    Route::get('show-paciente/{id}', [PacienteController::class, 'show']);
    Route::get('add-paciente', [PacienteController::class, 'add']);
    Route::post('insert-paciente', [PacienteController::class, 'insert']);
    Route::get('edit-paciente/{id}',[PacienteController::class,'edit']);
    Route::put('update-paciente/{id}', [PacienteController::class, 'update']);
    Route::get('delete-paciente/{id}', [PacienteController::class, 'destroy']);
    Route::get('pdf-pacientes', [PacienteController::class, 'pdf']);
    Route::get('pdf-paciente/{id}', [PacienteController::class, 'pdfpaciente']);
    Route::get('exportpacientes', [PacienteController::class, 'exportexcel']);

    //Recetas
    Route::post('insert-receta', [RecetaController::class, 'insert']);
    Route::put('update-receta/{id}', [RecetaController::class, 'update'])->name('update-receta');
    Route::get('delete-receta/{id}', [RecetaController::class, 'delete']);
    Route::get('print-receta', [RecetaController::class, 'print']);

    //Seguimientos
    Route::post('insert-seguimiento', [SeguimientoController::class, 'insert']);
    Route::put('update-seguimiento/{id}', [SeguimientoController::class, 'update'])->name('update-seguimiento');
    Route::get('delete-seguimiento/{id}', [SeguimientoController::class, 'delete']);
    Route::get('print-seguimiento', [SeguimientoController::class, 'print']);

    //Historia
    Route::get('edit-historia/{id}',[HistoriaController::class,'edit']);
    Route::put('update-historia/{id}', [HistoriaController::class, 'update']);
    Route::post('upload_imagen_historia', [HistoriaController::class, 'uploadimagen']);
    Route::get('print-historia', [HistoriaController::class, 'print']);

    //Documentos
    Route::get('show-documento/{id}', [DocumentoController::class, 'show']);
    Route::post('insert-documento', [DocumentoController::class, 'insert']);
    Route::put('update-documento/{id}', [DocumentoController::class, 'update']);
    Route::get('delete-documento/{id}', [DocumentoController::class, 'destroy']);

    //Terapia
    Route::get('show-terapia/{id}', [TerapiaController::class, 'show']);
    Route::post('insert-terapia', [TerapiaController::class, 'insert']);
    Route::put('update-terapia/{id}', [TerapiaController::class, 'update']);
    Route::get('delete-terapia/{id}', [TerapiaController::class, 'destroy']);
    Route::post('upload_imagen_terapia', [TerapiaController::class, 'uploadimagen']);
    Route::get('print-terapia', [TerapiaController::class, 'print']);

    Route::post('insert-sesion-derecha', [TerapiaController::class, 'insertsesionderecha']);
    Route::put('update-sesion-derecha/{id}', [TerapiaController::class, 'updatesesionderecha']);
    Route::get('delete-sesion-derecha/{id}', [TerapiaController::class, 'destroysesionderecha']);

    Route::post('insert-sesion-izquierda', [TerapiaController::class, 'insertsesionizquierda']);
    Route::put('update-sesion-izquierda/{id}', [TerapiaController::class, 'updatesesionizquierda']);
    Route::get('delete-sesion-izquierda/{id}', [TerapiaController::class, 'destroysesionizquierda']);

    //Clínicas
    Route::get('clinicas', [ClinicaController::class, 'index']);
    Route::get('show-clinica/{id}', [ClinicaController::class, 'show']);
    Route::get('add-clinica', [ClinicaController::class, 'add']);
    Route::post('insert-clinica',[ClinicaController::class,'insert']);
    Route::get('edit-clinica/{id}',[ClinicaController::class,'edit']);
    Route::put('update-clinica/{id}', [ClinicaController::class, 'update']);
    Route::get('delete-clinica/{id}', [ClinicaController::class, 'destroy']);
    Route::get('pdf-clinicas', [ClinicaController::class, 'pdf']);
    Route::get('pdf-clinica/{id}', [ClinicaController::class, 'pdfclinica']);

    //Citas
    Route::get('citas', [CitaController::class, 'index']);
    Route::get('show-cita/{id}', [CitaController::class, 'show']);
    Route::get('add-cita', [CitaController::class, 'add']);
    Route::post('insert-cita', [CitaController::class, 'insert']);
    Route::get('edit-cita/{id}',[CitaController::class,'edit']);
    Route::put('update-cita/{id}', [CitaController::class, 'update']);
    Route::get('delete-cita/{id}', [CitaController::class, 'destroy']);
    Route::get('print-citas', [CitaController::class, 'printcitas']);
    Route::get('print-cita', [CitaController::class, 'printcita']);
    Route::get('add-cita-paciente/{id}', [CitaController::class, 'addcitapaciente']);

    //Categorías
    Route::get('categorias', [CategoriaController::class, 'index']);
    Route::get('show-categoria/{id}', [CategoriaController::class, 'show']);
    Route::get('add-categoria', [CategoriaController::class, 'add']);
    Route::post('insert-categoria',[CategoriaController::class,'insert']);
    Route::get('edit-categoria/{id}',[CategoriaController::class,'edit']);
    Route::put('update-categoria/{id}', [CategoriaController::class, 'update']);
    Route::get('delete-categoria/{id}', [CategoriaController::class, 'destroy']);

    //Proveedores
    Route::get('proveedores', [ProveedorController::class, 'index']);
    Route::get('show-proveedor/{id}', [ProveedorController::class, 'show']);
    Route::get('add-proveedor', [ProveedorController::class, 'add']);
    Route::post('insert-proveedor',[ProveedorController::class,'insert']);
    Route::get('edit-proveedor/{id}',[ProveedorController::class,'edit']);
    Route::put('update-proveedor/{id}', [ProveedorController::class, 'update']);
    Route::get('delete-proveedor/{id}', [ProveedorController::class, 'destroy']);
    Route::get('pdf-proveedores', [ProveedorController::class, 'pdf']);
    Route::get('pdf-proveedor/{id}', [ProveedorController::class, 'pdfproveedor']);

    //articulos
    Route::get('articulos', [ArticuloController::class, 'index']);
    Route::get('show-articulo/{id}', [ArticuloController::class, 'show']);
    Route::get('add-articulo', [ArticuloController::class, 'add']);
    Route::post('insert-articulo',[ArticuloController::class,'insert']);
    Route::get('edit-articulo/{id}',[ArticuloController::class,'edit']);
    Route::put('update-articulo/{id}', [ArticuloController::class, 'update']);
    Route::get('delete-articulo/{id}', [ArticuloController::class, 'destroy']);
    Route::get('print-articulos', [ArticuloController::class, 'printarticulos']);
    Route::get('print-articulo', [ArticuloController::class, 'printarticulo']);

    //inventario
    Route::get('inventario', [InventarioController::class, 'index']);
    Route::get('print-inventario', [InventarioController::class, 'printinventario']);
    Route::get('exportinventario', [InventarioController::class, 'exportinventario']);

    //Ingresos
    Route::get('ingresos', [IngresoController::class, 'index']);
    Route::get('show-ingreso/{id}', [IngresoController::class, 'show']);
    Route::get('add-ingreso', [IngresoController::class, 'add']);
    Route::post('insert-ingreso',[IngresoController::class,'insert']);
    Route::get('edit-ingreso/{id}',[IngresoController::class,'edit']);
    Route::put('update-ingreso/{id}', [IngresoController::class, 'update']);
    Route::get('delete-ingreso/{id}', [IngresoController::class, 'destroy']);
    Route::get('print-ingresos', [IngresoController::class, 'printingresos']);
    Route::get('print-ingreso', [IngresoController::class, 'printingreso']);

    //Ingresos Pagos
    Route::post('insert-pago', [PagoIngresoController::class, 'insert']);
    Route::put('update-pago/{id}', [PagoIngresoController::class, 'update']);
    Route::get('delete-pago/{id}', [PagoIngresoController::class, 'destroy']);

    //Ventas
    Route::get('ventas', [VentaController::class, 'index']);
    Route::get('show-venta/{id}', [VentaController::class, 'show']);
    Route::get('add-venta', [VentaController::class, 'add']);
    Route::post('insert-venta',[VentaController::class,'insert']);
    Route::get('edit-venta/{id}',[VentaController::class,'edit']);
    Route::put('update-venta/{id}', [VentaController::class, 'update']);
    Route::get('delete-venta/{id}', [VentaController::class, 'destroy']);
    Route::get('delete-detalle-venta/{id}', [VentaController::class, 'destroydetalle']);
    Route::post('insert-detalle-venta', [VentaController::class, 'insertdetalle']);
    Route::get('print-ventas', [VentaController::class, 'printventas']);
    Route::get('print-venta', [VentaController::class, 'printventa']);

    //Ventas Pagos
    Route::post('insert-pago-venta', [PagoVentaController::class, 'insert']);
    Route::put('update-pago-venta/{id}', [PagoVentaController::class, 'update']);
    Route::get('delete-pago-venta/{id}', [PagoVentaController::class, 'destroy']);

    //Bariatría
    Route::get('show-bariatria/{id}', [BariatriaController::class, 'show']);
    Route::post('insert-bariatria', [BariatriaController::class, 'insert']);
    Route::put('update-bariatria/{id}', [BariatriaController::class, 'update']);
    Route::get('delete-bariatria/{id}', [BariatriaController::class, 'destroy']);
    Route::post('upload_imagen_bariatria', [BariatriaController::class, 'uploadimagen']);
    Route::get('print-bariatria', [BariatriaController::class, 'print']);

    //config
    Route::get('config', [ConfigController::class, 'index']);
    Route::put('update-config', [ConfigController::class, 'update']);
 });

//  Route::middleware(['auth', 'isAdmin'])->group(function () {
//     //front user
// });
