<?php

use GlobalStudio\University\Controllers\CourseController;
use GlobalStudio\University\Controllers\DestinationController;
use GlobalStudio\University\Controllers\VisaController;
use GlobalStudio\University\Controllers\UniversityController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['web', 'auth']], function () {

        Route::get('/courses', [CourseController::class, 'index'])
            ->name('admin.course.index');
        Route::get('/courses/create', [CourseController::class, 'create'])
            ->name('admin.course.create');
        Route::get('/courses/edit/{id}', [CourseController::class, 'edit'])
            ->name('admin.course.edit');
        Route::post('/courses/update', [CourseController::class, 'update'])
            ->name('admin.course.update');
        Route::post('/courses/store', [CourseController::class, 'store'])
            ->name('admin.course.store');
        Route::post('/courses/delete', [CourseController::class, 'delete'])
            ->name('admin.course.delete');
        Route::get('/courses/search', [CourseController::class, 'search'])
            ->name('admin.course.search');

        Route::get('/visa', [VisaController::class, 'index'])
            ->name('admin.visa.index');
        Route::get('/visa/create', [VisaController::class, 'create'])
            ->name('admin.visa.create');
        Route::get('/visa/edit/{id}', [VisaController::class, 'edit'])
            ->name('admin.visa.edit');
        Route::post('/visa/update', [VisaController::class, 'update'])
            ->name('admin.visa.update');
        Route::post('/visa/store', [VisaController::class, 'store'])
            ->name('admin.visa.store');
        Route::post('/visa/delete', [VisaController::class, 'delete'])
            ->name('admin.visa.delete');
        Route::get('/visa/search', [VisaController::class, 'search'])
            ->name('admin.visa.search');

        Route::get('/destinations', [DestinationController::class, 'index'])
            ->name('admin.destination.index');
        Route::get('/destinations/create', [DestinationController::class, 'create'])
            ->name('admin.destination.create');
        Route::get('/destinations/edit/{id}', [DestinationController::class, 'edit'])
            ->name('admin.destination.edit');
        Route::post('/destinations/update', [DestinationController::class, 'update'])
            ->name('admin.destination.update');
        Route::post('/destinations/store', [DestinationController::class, 'store'])
            ->name('admin.destination.store');
        Route::post('/destinations/delete', [DestinationController::class, 'delete'])
            ->name('admin.destination.delete');
        Route::get('/destinations/search', [DestinationController::class, 'search'])
            ->name('admin.destination.search');

        Route::get('/universities', [UniversityController::class, 'index'])
            ->name('admin.university.index');
        Route::get('/universities/create', [UniversityController::class, 'create'])
            ->name('admin.university.create');
        Route::get('/universities/edit/{id}', [UniversityController::class, 'edit'])
            ->name('admin.university.edit');
        Route::post('/universities/update', [UniversityController::class, 'update'])
            ->name('admin.university.update');
        Route::post('/universities/store', [UniversityController::class, 'store'])
            ->name('admin.university.store');
        Route::post('/universities/delete', [UniversityController::class, 'delete'])
            ->name('admin.university.delete');
        Route::get('/universities/search', [UniversityController::class, 'search'])
            ->name('admin.university.search');
    });
});
