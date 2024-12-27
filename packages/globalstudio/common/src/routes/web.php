<?php

use Illuminate\Support\Facades\Route;
use GlobalStudio\Common\Controllers\BlogController;
use GlobalStudio\Common\Controllers\PageController;
use GlobalStudio\Common\Controllers\TeamController;
use GlobalStudio\Common\Controllers\UserController;
use GlobalStudio\Common\Controllers\BranchController;
use GlobalStudio\Common\Controllers\CourseController;
use GlobalStudio\Common\Controllers\SliderController;
use GlobalStudio\Common\Controllers\ServiceController;
use GlobalStudio\Common\Controllers\DashboardController;
use GlobalStudio\Common\Controllers\DepartmentController;
use GlobalStudio\Common\Controllers\SiteConfigController;
use GlobalStudio\Common\Controllers\BlogCommentController;
use GlobalStudio\Common\Controllers\TestimonialController;
use GlobalStudio\Common\Controllers\WhyChooseUsController;
use GlobalStudio\Common\Controllers\BlogCategoryController;
use GlobalStudio\Common\Controllers\AdverstisementController;
use GlobalStudio\Common\Controllers\BackendBookingController;
use GlobalStudio\Common\Controllers\BackendContactController;
use GlobalStudio\Common\Controllers\ServicePackageController;
use GlobalStudio\Common\Controllers\TraderChooseUsController;
use GlobalStudio\Common\Controllers\ServiceCategoryController;
use GlobalStudio\Common\Controllers\DestinationContactController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['web', 'auth']], function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::get('/users', [UserController::class, 'index'])
            ->name('admin.user.index');
        Route::get('/users/create', [UserController::class, 'create'])
            ->name('admin.user.create');
        Route::get('/users/edit/{id}', [UserController::class, 'edit'])
            ->name('admin.user.edit');
        Route::post('/users/update', [UserController::class, 'update'])
            ->name('admin.user.update');
        Route::post('/users/store', [UserController::class, 'store'])
            ->name('admin.user.store');
        Route::post('/users/delete', [UserController::class, 'delete'])
            ->name('admin.user.delete');
        Route::get('/users/search', [UserController::class, 'search'])
            ->name('admin.user.search');

       

        Route::get('/contacts', [BackendContactController::class, 'index'])
            ->name('admin.contact.index');
        Route::get('/contacts/search', [BackendContactController::class, 'search'])
            ->name('admin.contact.search');

            Route::get('/newsletters', [BackendContactController::class, 'newsletter_index'])
            ->name('admin.newsletter.index');
        Route::get('/newsletters/search', [BackendContactController::class, 'newsletter_search'])
            ->name('admin.newsletter.search');

            
        Route::get('/sliders', [SliderController::class, 'index'])
            ->name('admin.slider.index');
        Route::get('/sliders/create', [SliderController::class, 'create'])
            ->name('admin.slider.create');
        Route::get('/sliders/edit/{id}', [SliderController::class, 'edit'])
            ->name('admin.slider.edit');
        Route::post('/sliders/update', [SliderController::class, 'update'])
            ->name('admin.slider.update');
        Route::post('/sliders/store', [SliderController::class, 'store'])
            ->name('admin.slider.store');
        Route::post('/sliders/delete', [SliderController::class, 'delete'])
            ->name('admin.slider.delete');
        Route::get('/sliders/search', [SliderController::class, 'search'])
            ->name('admin.slider.search');

       

        Route::get('/teams', [TeamController::class, 'index'])
            ->name('admin.team.index');
        Route::get('/teams/create', [TeamController::class, 'create'])
            ->name('admin.team.create');
        Route::get('/teams/edit/{id}', [TeamController::class, 'edit'])
            ->name('admin.team.edit');
        Route::post('/teams/update', [TeamController::class, 'update'])
            ->name('admin.team.update');
        Route::post('/teams/store', [TeamController::class, 'store'])
            ->name('admin.team.store');
        Route::post('/teams/delete', [TeamController::class, 'delete'])
            ->name('admin.team.delete');
        Route::get('/teams/search', [TeamController::class, 'search'])
            ->name('admin.team.search');
        Route::get('/teams/view/{id}', [TeamController::class, 'show'])
            ->name('admin.team.view');

        Route::get('/pages', [PageController::class, 'index'])
            ->name('admin.page.index');
        Route::get('/pages/create', [PageController::class, 'create'])
            ->name('admin.page.create');
        Route::get('/pages/edit/{id}', [PageController::class, 'edit'])
            ->name('admin.page.edit');
        Route::post('/pages/update', [PageController::class, 'update'])
            ->name('admin.page.update');
        Route::post('/pages/store', [PageController::class, 'store'])
            ->name('admin.page.store');
        Route::post('/pages/delete', [PageController::class, 'delete'])
            ->name('admin.page.delete');
        Route::get('/pages/search', [PageController::class, 'search'])
            ->name('admin.page.search');

        Route::get('/blogs', [BlogController::class, 'index'])
            ->name('admin.blog.index');
        Route::get('/blogs/create', [BlogController::class, 'create'])
            ->name('admin.blog.create');
        Route::get('/blogs/edit/{id}', [BlogController::class, 'edit'])
            ->name('admin.blog.edit');
        Route::post('/blogs/update', [BlogController::class, 'update'])
            ->name('admin.blog.update');
        Route::post('/blogs/store', [BlogController::class, 'store'])
            ->name('admin.blog.store');
        Route::post('/blogs/delete', [BlogController::class, 'delete'])
            ->name('admin.blog.delete');
        Route::get('/blogs/search', [BlogController::class, 'search'])
            ->name('admin.blog.search');

            Route::get('/why_choose_us', [WhyChooseUsController::class, 'index'])
            ->name('admin.why_choose_us.index');
        Route::get('/why_choose_us/create', [WhyChooseUsController::class, 'create'])
            ->name('admin.why_choose_us.create');
        Route::get('/why_choose_us/edit/{id}', [WhyChooseUsController::class, 'edit'])
            ->name('admin.why_choose_us.edit');
        Route::post('/why_choose_us/update', [WhyChooseUsController::class, 'update'])
            ->name('admin.why_choose_us.update');
        Route::post('/why_choose_us/store', [WhyChooseUsController::class, 'store'])
            ->name('admin.why_choose_us.store');
        Route::post('/why_choose_us/delete', [WhyChooseUsController::class, 'delete'])
            ->name('admin.why_choose_us.delete');
        Route::get('/why_choose_us/search', [WhyChooseUsController::class, 'search'])
            ->name('admin.why_choose_us.search');

            Route::get('/trader_choose_us', [TraderChooseUsController::class, 'index'])
            ->name('admin.trader_choose_us.index');
        Route::get('/trader_choose_us/create', [TraderChooseUsController::class, 'create'])
            ->name('admin.trader_choose_us.create');
        Route::get('/trader_choose_us/edit/{id}', [TraderChooseUsController::class, 'edit'])
            ->name('admin.trader_choose_us.edit');
        Route::post('/trader_choose_us/update', [TraderChooseUsController::class, 'update'])
            ->name('admin.trader_choose_us.update');
        Route::post('/trader_choose_us/store', [TraderChooseUsController::class, 'store'])
            ->name('admin.trader_choose_us.store');
        Route::post('/trader_choose_us/delete', [TraderChooseUsController::class, 'delete'])
            ->name('admin.trader_choose_us.delete');
        Route::get('/trader_choose_us/search', [TraderChooseUsController::class, 'search'])
            ->name('admin.trader_choose_us.search');

        

        Route::get('/site-config', [SiteConfigController::class, 'index'])
            ->name('admin.site-config');
        Route::post('/site-config/update', [SiteConfigController::class, 'update'])
            ->name('admin.site-config.update');

       

            //Bookings

 Route::get('bookings', [BackendBookingController::class, 'index'])
            ->name('admin.book.index');
            Route::get('books/search', [BackendBookingController::class, 'search'])
            ->name('admin.book.search');
        //service
        Route::get('/service', [ServiceController::class, 'index'])
            ->name('admin.service.index');
        Route::get('/service-ceate', [ServiceController::class, 'create'])
            ->name('admin.service.create.form');

        Route::post('/service/store', [ServiceController::class, 'store'])
            ->name('admin.service.store');

        Route::get('/service/search', [ServiceController::class, 'search'])
            ->name('admin.service.search');
        Route::get('/service/edit/{id}', [ServiceController::class, 'edit'])
            ->name('admin.service.edit');

        Route::post('/service/update/{id}', [ServiceController::class, 'update'])
            ->name('admin.service.update');

        Route::post('/admin/service/delete/{id}', [Servicecontroller::class, 'delete'])
            ->name('admin.service.delete');
            Route::get('/services/view/{id}', [Servicecontroller::class, 'show'])
            ->name('admin.service.view');
            Route::put('/service-priority/update/{id}', [ServiceController::class, 'priorityUpdate'])
            ->name('admin.priority.update');
       

       
    });
});
