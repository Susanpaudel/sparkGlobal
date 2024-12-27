<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;


Route::get('/',[HomeController::class, 'index'])->name('index');

Route::get('/about-us',[HomeController::class, 'about'])->name('about');

Route::get('/services',[HomeController::class, 'service'])->name('service');
Route::get('/service/{slug}',[HomeController::class, 'service_single'])->name('service-single');
Route::get('/blogs',[HomeController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}',[HomeController::class,'blog_single'])->name('blog-single');

Route::get('/teams',[HomeController::class, 'team'])->name('team');
Route::get('/contact',[HomeController::class, 'contact'])->name('contact');
Route::post('/contact-store',[HomeController::class, 'contact_store'])->name('contact-store');
Route::post('/newsletter-store',[HomeController::class, 'newsletter_store'])->name('newsletter-store');
Route::get('/company-histories',[HomeController::class, 'companyHistory'])->name('company-history');
Route::get('/transports',[HomeController::class, 'transport'])->name('transport');
Route::get('/maintenances',[HomeController::class, 'maintenance'])->name('maintenance');
Route::get('/equipments',[HomeController::class, 'equipment'])->name('equipment');
Route::get('/life-supports',[HomeController::class, 'lifeSupport'])->name('life-support');
Route::get('/people-outsourcing',[HomeController::class, 'peopleOutsourcing'])->name('people-outsourcing');


