<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

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
    return view('dashboard');
});

Route::get('/students', [StudentController::class, 'index']);

Route::get('/get-data', [StudentController::class, "studentData"]);

Route::post('/students/store', [StudentController::class, 'store'])->name('student.store');

Route::put('/students/update/{id}',[StudentController::class,'update'])->name('student.update');

Route::delete('/students/delete/{id}', [StudentController::class, 'destroy'])->name('student.delete');
