<?php
/**
 * @Author: Anwarul
 * @Date: 2025-11-17 14:53:56
 * @LastEditors: Anwarul
<<<<<<< HEAD
 * @LastEditTime: 2026-01-08 15:14:02
=======
 * @LastEditTime: 2026-01-05 17:22:19
>>>>>>> e9636aae66c03ba99cd90ef9ac7f005894d35bf4
 * @Description: Innova IT
 */

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookFileController;
use App\Http\Controllers\BookQrCodeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\QuizQuestionController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('order_change', [QuizQuestionController::class, 'order_change'])->name('order_change');
Route::post('import_question', [QuizQuestionController::class, 'import_question'])->name('import_question');
Route::group(['namespace' => 'App\Http\Controllers'], function()
{
Route::group(['middleware' => ['auth','permission']], function() {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::resource('roles', RolesController::class);
    Route::resource('users', UsersController::class);
    Route::resource('permissions', PermissionsController::class);
    Route::resource('division', DivisionController::class);
    Route::resource('district', DistrictController::class);
    Route::resource('thana', ThanaController::class);
    Route::resource('setting', SettingController::class);
    Route::resource('course', CourseController::class);
    Route::resource('book', BookController::class);
    Route::resource('book_file', BookFileController::class);
    Route::resource('module', ModuleController::class);
    Route::resource('lessons', LessonController::class);
    Route::resource('quiz_question', QuizQuestionController::class);
    Route::resource('book_qr_code', BookQrCodeController::class);
    Route::get('/print_book_qr_codes', [BookQrCodeController::class, 'print_book_qr_codes'])->name('book_qr_code.print');

});
});
