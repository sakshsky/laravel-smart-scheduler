<?php

namespace Sakshsky\SmartScheduler;

use Illuminate\Support\ServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class SmartSchedulerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-smart-scheduler')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_scheduled_tasks_table')
            ->hasRoute('web');
    }

    public function packageRegistered()
    {
        $this->app->singleton('smart-scheduler', function () {
            return new SmartScheduler;
        });
    }
}