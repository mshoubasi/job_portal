<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\MyJobController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\MyJobApplicationController;

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

Route::get('', fn () => to_route('jobs.index'));
Route::resource('jobs', JobController::class);
Route::middleware('auth')->group(function () {
    Route::resource('employer', EmployerController::class)->only(['create', 'store']);
    Route::resource('jobs.application', JobApplicationController::class)->only(['create', 'store', 'destroy']);
    Route::middleware('employer')->group(function () {
        Route::put('my-job/{jobApplication}/approve', [ReviewController::class, 'approve'])->name('job.approve');
        Route::get('my-job/{JobApplication}/download/', [ReviewController::class, 'download'])->name('job.download');
        Route::resource('my-job', MyJobController::class);
    });
    Route::resource('my-applications', MyJobApplicationController::class)->only(['index', 'destroy']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
