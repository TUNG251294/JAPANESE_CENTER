<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['courses.list', 'users.admin.list', 'users.teacher.list', 'users.student.list',], function ($view) {
            $view->with('isSearchForm', true);
        });

        View::composer([
            'courses.create', 'courses.update', 'courses.personal-list', 'courses.info', 'courses.manage-session', 'users.teacher.attendance',
            'users.admin.info', 'users.admin.update-info', 'users.admin.receipt-fee', 'users.teacher.info', 'users.teacher.update-info',
            'users.student.info', 'users.student.update-info', 'users.student.register', 'form.auth.create-admin', 'form.auth.create-teacher',
            'form.auth.create-student', 'users.admin.update', 'users.teacher.update', 'users.student.update',
        ], function ($view) {
            $view->with(['isSearchForm' => false, 'searchKey' => '']);
        });
    }
}
