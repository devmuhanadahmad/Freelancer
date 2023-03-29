<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoleUser;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\SoialLoginController;
use App\Http\Controllers\Freelancer\PropsalController;
use App\Http\Controllers\Front\FreelanserController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProjectController as FrontProjectController;
use App\Http\Controllers\Test\AuthController;
use App\Http\Controllers\Test\HomeController as TestHomeController;
use Illuminate\Support\Facades\Route;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

//require __DIR__ . '/auth.php';

Route::get('/', [TestHomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('web.home');

Route::controller(AuthController::class)->prefix('auth/')->as('auth.')->group(function () {
    Route::get('loginForm', 'loginForm')->name('login.form');
    Route::post('login', 'login')->name('login');
    Route::post('logout', 'logout')->name('logout');
    Route::get('registerForm', 'registerForm')->name('register.form');
    Route::post('register', 'register')->name('register');
});

Route::get('auth/{provider}/redirect', [SoialLoginController::class, 'redirect'])
    ->name('auth.socilaite.redirect');
Route::get('auth/{provider}/callback', [SoialLoginController::class, 'callback'])
    ->name('auth.socilaite.callback');



Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
   // 'prefix' => '/admin',
    'middleware' => ['auth', 'web'],
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/roleuser', RoleUser::class)->names('roleuser');
    Route::resource('/categories', CategoryController::class)->names('category');
    Route::resource('/users', UserController::class)->names('users');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::resource('/project', ProjectController::class)->names('project');
    Route::resource('/role', RoleController::class)->names('role');
});



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
        'middleware'=>['auth', 'web'],
    ], function () {
        Route::get('/my-project', [FrontProjectController::class, 'show'])->name('front.project.show');
        Route::post('/project/store', [FrontProjectController::class, 'store'])->name('front.project.store');
        Route::post('/proposal/{project}/store', [PropsalController::class, 'store'])->name('proposal.store');
    });
    Route::get('/project/create', [FrontProjectController::class, 'create'])->name('front.project.create');
    Route::get('/all-project', [FrontProjectController::class, 'index'])->name('front.project.index');
    Route::get('/freelanser', [FreelanserController::class, 'showFreelansers'])->name('allFreelansers');
    Route::get('/FreelanserProfile/{user}/show', [FreelanserController::class, 'showFreelanserProfile'])->name('showFreelanserProfile');
    Route::get('/contact-us', [FrontProjectController::class, 'contactUs'])->name('contactUs');
    Route::get('/proposal', [PropsalController::class, 'index'])->name('proposal.index');
    Route::get('/proposal/{project}/create', [PropsalController::class, 'create'])->name('proposal.create');
