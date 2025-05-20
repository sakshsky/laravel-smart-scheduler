<?php

namespace Sakshsky\SmartScheduler\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallSchedulerCommand extends Command
{
    protected $signature = 'smart-scheduler:install';
    protected $description = 'Install the Smart Scheduler package';

    public function handle()
    {
        $this->info('Installing Smart Scheduler...');
        
        // Publish assets
        $this->call('vendor:publish', [
            '--provider' => 'Sakshsky\SmartScheduler\Providers\SmartSchedulerServiceProvider',
            '--tag' => 'assets'
        ]);
        
        $this->info('Smart Scheduler installed successfully!');
    }
}