<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApuActivityApuController;
use App\Http\Controllers\ApuActivityController;
use App\Http\Controllers\ApuController;
use App\Http\Controllers\ApuInternalChapterController;
use App\Http\Controllers\ApuLaborPriceController;
use App\Http\Controllers\ApuMaterialController;
use App\Http\Controllers\ApuToolController;
use App\Http\Controllers\ApuTransportPriceController;
//  use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChapterApuActivityController;
use App\Http\Controllers\ChapterApuLaborPriceController;
use App\Http\Controllers\ChapterApuMaterialController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\CommercialOfferController;
use App\Http\Controllers\CommercialOffersCotizationController;
use App\Http\Controllers\CommercialOffersManagementController;
use App\Http\Controllers\CommercialOffersManagementFileController;
use App\Http\Controllers\CommercialOffersSeguimientoController;
use App\Http\Controllers\CustomerApuActivityController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\DepartamentoMunicipioController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProjectManagementController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SupplyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
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

//AUTH
Route::get('register', [RegisterController::class, 'show']);
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::get('login', [LoginController::class, 'show']);
Route::post('logout', [LoginController::class, 'logout']);

// Route::middleware(['auth.custom'])->group(function () {
    //EMPLOYEES ROUTES
    Route::get('/employee', 'EmployeeController@index')->name('employee.index');
    Route::get('employees',  [EmployeeController::class, 'index']);
    Route::get('employees/create',  [EmployeeController::class, 'create']);
    Route::post('employees',  [EmployeeController::class, 'store']);
    Route::delete('employees/{employee_id}',  [EmployeeController::class, 'destroy']);
    Route::patch('employees/{employee_id}',  [EmployeeController::class, 'update']);
    Route::patch('/employees/{employee}', 'EmployeeController@update');
    Route::get('employees/{employee_id}',  [EmployeeController::class, 'edit']);

// });

//users
Route::get('users',  [UserController::class, 'index']);
Route::get('users/create',  [UserController::class, 'create']);
Route::post('users',  [UserController::class, 'store']);
Route::delete('users/{user_id}',  [UserController::class, 'destroy']);
Route::patch('users/{user_id}',  [UserController::class, 'update']);
Route::get('users/{user_id}',  [UserController::class, 'edit']);





Route::get('/verify', function () {
    $variable = "hello";
    return view('mail.commercialOffer.commercialoffer-assigned-notification', array(["data" => ["variable" => $variable]]),);
});
