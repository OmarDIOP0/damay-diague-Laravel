<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginAdminController;
use App\Http\Controllers\SommaireItemController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RegisterAdminController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ForgotPasswordController;

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

//routes


//groupe

// Route::group([
//     'middleware' => 'inscrit'
// ], function () {
//     Route::get('/register', [RegisterController::class, 'index'])->name('register');
//     Route::get('/login', [LoginController::class, 'index'])->name('login');
// });


// Route::group([
//     'middleware' => 'estconnecte'
// ], function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cour', [CoursController::class, 'index']);

Route::get('/cours/suites', [CoursController::class, 'viewCours']);



Route::post('/admin/login', [LoginAdminController::class, 'store']);
Route::post('/admin/register', [RegisterAdminController::class, 'store']);

// Route::middleware(['auth'])->group(function () {
    Route::get('/admin/register', [RegisterAdminController::class, 'index'])->name('register');
    Route::get('/admin/login', [LoginAdminController::class, 'index'])->name('admin.login');
// });

// Route::group(['middleware' => 'estconnecte'], function () {
    // Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');
    Route::get('/admin/profile',[AdminController::class,'profile'])->name('admin.profile');
    Route::get('/admin/cour',[AdminController::class,'cours'])->name('admin.cour');
    Route::post('/admin/cour',[CoursController::class,'create']);
    Route::get('/admin/deleteCour/{id}',[CoursController::class,'destroy']);
    Route::get('/admin/updateCour/{id}',[CoursController::class,'edit']);
    Route::post('/admin/updateCour/{id}',[CoursController::class,'update']);
    Route::get('/admin/logout',[AdminController::class,'logout']);
    Route::get('/admin/niveau',[LevelController::class,'index'])->name('admin.niveau');
    Route::post('/admin/niveau',[LevelController::class,'create']);
    Route::get('/admin/deleteNiveau/{id}',[LevelController::class,'destroy']);
    Route::get('/admin/updateNiveau/{id}',[LevelController::class,'edit']);
    Route::post('/admin/updateNiveau/{id}',[LevelController::class,'update']);
    Route::get('/admin/matiere',[MatiereController::class,'index'])->name('admin.matiere');
    Route::post('/admin/matiere',[MatiereController::class,'create']);
    Route::get('/admin/eleve',[AdminController::class,'eleve']);
    Route::post('/admin/eleve',[AdminController::class,'createEleve']);
    Route::get('/admin/deleteEleve/{id}',[AdminController::class,'destroyEleve']);
    Route::get('/admin/updateEleve/{id}',[AdminController::class,'edit']);
    Route::post('/admin/updateEleve/{id}',[AdminController::class,'updateEleve']);
    Route::get('/admin/deleteMatiere/{id}',[MatiereController::class,'destroy'])->name('delete-matiere');
    Route::get('/admin/updateMatiere/{id}',[MatiereController::class,'edit']);
    Route::post('/admin/updateMatiere/{id}',[MatiereController::class,'update']);
    Route::get('/admin/viewCour/{slug}',[CoursController::class,'view']);
    Route::get('/admin/sommaire',[SommaireItemController::class,'index']);
    Route::post('/admin/sommaire',[SommaireItemController::class,'create']);
//   });

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/modifier/{id}', [DashboardController::class, 'show'])->name('modififer');
    Route::post('/modifier/{id}', [DashboardController::class, 'update'])->name('modifier');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['guest'])->group(function () {
    Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'store'])->name('password.update');
});


Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
// Route::get('/login', [LoginController::class, 'index'])->name('login');
// Route::post('/login', [LoginController::class, 'store']);
Route::get('/cours', [CoursController::class, 'index']);

Route::get('/cours/suites', [CoursController::class, 'viewCours']);

// Route::group(['auth'], function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
//     Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
//     Route::get('/admin/cour', [AdminController::class, 'cours'])->name('admin.cour');
//     Route::get('/logout', [AdminController::class, 'store']);
//     Route::get('/admin/niveau', [LevelController::class, 'index'])->name('admin.niveau');
//     Route::post('/admin/niveau', [LevelController::class, 'create']);
//     Route::get('/admin/deleteNiveau/{id}', [LevelController::class, 'destroy']);
//     Route::get('/admin/updateNiveau/{id}', [LevelController::class, 'edit']);
//     Route::post('/admin/updateNiveau/{id}', [LevelController::class, 'update']);
//     Route::get('/admin/matiere', [MatiereController::class, 'index']);
//     Route::post('/admin/matiere', [MatiereController::class, 'create']);
//     Route::get('/admin/deleteMatiere/{id}', [MatiereController::class, 'destroy']);
//     Route::get('/admin/updateMatiere/{id}', [MatiereController::class, 'edit']);
//     Route::post('/admin/updateMatiere/{id}', [MatiereController::class, 'update']);
// });

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/modifier/{id}', [DashboardController::class, 'show'])->name('modififer');
    Route::post('/modifier/{id}', [DashboardController::class, 'update'])->name('modifier');
});
