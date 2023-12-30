<?php

use App\Models\Company;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $jumlahpegawai = Employee::count();
    $jumlahpegawaicowo = Employee::where('jeniskelamin','cowo')->count();
    $jumlahpegawaicewe = Employee::where('jeniskelamin','cewe')->count();

    $jumlahperusahaan = Company::count();
    $jumlahdepartment = Department::count();

    return view('welcome', compact('jumlahpegawai','jumlahpegawaicowo','jumlahpegawaicewe','jumlahperusahaan','jumlahdepartment'));
});

Route::get('/pegawai', [EmployeeController::class, 'index'])->name('pegawai')->middleware('auth');

Route::get('/tambahpegawai', [EmployeeController::class, 'tambahpegawai'])->name('tambahpegawai');
Route::post('/insertdata', [EmployeeController::class, 'insertdata'])->name('insertdata');

Route::get('/tampilkandata/{id}', [EmployeeController::class, 'tampilkandata'])->name('tampilkandata');
Route::post('/updatedata/{id}', [EmployeeController::class, 'updatedata'])->name('updatedata');

Route::get('/delete/{id}', [EmployeeController::class, 'delete'])->name('delete');

// Export PDF
Route::get('/exportpdf', [EmployeeController::class, 'exportpdf'])->name('exportpdf');

// Export Excel
Route::get('/exportexcel', [EmployeeController::class, 'exportexcel'])->name('exportexcel');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('loginproses');


Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/registeruser', [LoginController::class, 'registeruser'])->name('registeruser');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


//tabel Company
Route::get('/perusahaan', [CompanyController::class, 'index'])->name('perusahaan')->middleware('auth');

Route::get('/tambahperusahaan', [CompanyController::class, 'tambahperusahaan'])->name('tambahperusahaan');
Route::post('/insertperusahaan', [CompanyController::class, 'insertperusahaan'])->name('insertperusahaan');

Route::get('/tampilkanperusahaan/{id}', [CompanyController::class, 'tampilkanperusahaan'])->name('tampilkanperusahaan');
Route::post('/updateperusahaan/{id}', [CompanyController::class, 'updateperusahaan'])->name('updateperusahaan');

Route::get('/delete/{id}', [CompanyController::class, 'delete'])->name('delete');


//tabel Gaji
Route::get('/gaji', [GajiController::class, 'index'])->name('gaji')->middleware('auth');

Route::get('/tambahgaji', [GajiController::class, 'tambahgaji'])->name('tambahgaji');
Route::post('/insertgaji', [GajiController::class, 'insertgaji'])->name('insertgaji');

Route::get('/tampilkangaji/{id}', [GajiController::class, 'tampilkangaji'])->name('tampilkangaji');
Route::post('/updategaji/{id}', [GajiController::class, 'updategaji'])->name('updategaji');

Route::get('/delete/{id}', [GajiController::class, 'deletegaji'])->name('delete');


//tabel Departemen
Route::get('/department', [DepartmentController::class, 'index'])->name('department')->middleware('auth');

Route::get('/tambahdepartment', [DepartmentController::class, 'tambahdepartment'])->name('tambahdepartment');
Route::post('/insertdepartment', [DepartmentController::class, 'insertdepartment'])->name('insertdepartment');

Route::get('/tampilkandepartment/{id}', [DepartmentController::class, 'tampilkandepartment'])->name('tampilkandepartment');
Route::post('/updatedepartment/{id}', [DepartmentController::class, 'updatedepartment'])->name('updatedepartment');

Route::get('/delete/{id}', [DepartmentController::class, 'delete'])->name('delete');
