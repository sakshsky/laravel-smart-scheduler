<?php

namespace Sakshsky\SmartScheduler\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Cron\CronExpression;

class SmartSchedulerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'smart-scheduler');
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'smart-scheduler');

        Validator::extend('cron_expression', function ($attribute, $value, $parameters, $validator) {
            try {
                CronExpression::factory($value);
                return true;
            } catch (\Exception $e) {
                return false;
            }
        }, 'Invalid cron expression format');

        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Commands\InstallSchedulerCommand::class,
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/smart-scheduler.php', 'smart-scheduler'
        );
    }
}