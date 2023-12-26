<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OtherStaffController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



// Routes accessibles uniquement par les administrateurs
// Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
//     Route::resource('admin', AdminController::class);
    // Ajoutez d'autres routes spécifiques à l'administrateur ici

//});

// Routes accessibles uniquement par les utilisateurs
// Route::middleware(['auth:sanctum', 'role:user'])->group(function () {
//     // Ajoutez des routes spécifiques aux utilisateurs ici

// });

// Routes accessibles uniquement par les secrétaires
// Route::middleware(['auth:sanctum', 'role:secretary'])->group(function () {
//     // Ajoutez des routes spécifiques aux secrétaires ici

// });

Route::post('/register', [RegisterController::class, 'store']);
Route::post('/login', [LoginController::class, 'check']);
//admin
Route::post('/AddAdmin', [AdminController::class, 'store']);
Route::get('/listAdmin', [AdminController::class, 'index']);
Route::get('/updateAdmin/{id}', [AdminController::class, 'show']);
Route::put('/updateAdmin/{id}', [AdminController::class, 'update']);
Route::delete('/getUsers/{id}', [AdminController::class, 'destroy']);
//department
Route::post('/AddDepartment', [DepartmentController::class, 'store']);
Route::get('/listDepartment', [DepartmentController::class, 'index']);
Route::get('/updateDepartment/{id}', [DepartmentController::class, 'show']);
Route::put('/updateDepartment/{id}', [DepartmentController::class, 'update']);
Route::delete('/getDepartments/{id}', [DepartmentController::class, 'destroy']);
//doctor
Route::post('/AddDoctor', [DoctorController::class, 'store']);
Route::get('/listDoctor', [DoctorController::class, 'index']);
Route::get('/updateDoctor/{DoctorID}', [DoctorController::class, 'show']);
Route::put('/updateDoctor/{id}', [DoctorController::class, 'update']);
Route::delete('/getDoctor/{id}', [DoctorController::class, 'destroy']);
//user
Route::post('/AddUser', [UserController::class, 'store']);
Route::get('/listUser', [UserController::class, 'index']);
Route::get('/updateUser/{id}', [UserController::class, 'show']);
Route::put('/updateUser/{id}', [UserController::class, 'update']);
Route::delete('/getUsers/{id}', [UserController::class, 'destroy']);
// Staff route
//Route::post('/AddStaff', [OtherStaffController::class, 'store']);
//Route::post('/AddStaff', 'OtherStaffController@store');
//Route::middleware('api')->post('/api/AddStaff', [OtherStaffController::class, 'store']);
//Route::post('/api/AddStaff', [OtherStaffController::class, 'store']);
//Route::post('/api/AddStaff', [OtherStaffController::class, 'store']);

//Route::get('/listStaff', [OtherStaffController::class, 'index']);

Route::post('/AddStaff', [OtherStaffController::class, 'store']);
Route::get('/getAllStaf', [OtherStaffController::class, 'index']);
Route::get('/getAllStaf/{doctorId}', [OtherStaffController::class, 'getDoctorById']);

