<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cron\CronExpression;

class SchedulerBuilder extends Component
{
    public $taskName = '';
    public $command = '';
    public $frequency = 'daily';
    public $customExpression = '';
    public $time = '00:00';
    public $timezone = 'UTC';
    public $generatedCode = '';

    protected $frequencyMap = [
        'hourly' => '0 * * * *',
        'daily' => '0 0 * * *',
        'weekly' => '0 0 * * 0',
        'monthly' => '0 0 1 * *',
        'yearly' => '0 0 1 1 *',
        'custom' => null,
    ];

    public function generateCode()
    {
        $cronExpression = $this->frequency === 'custom' 
            ? $this->customExpression
            : $this->buildExpression();

        $this->validate([
            'taskName' => 'required|string|max:255',
            'command' => 'required|string',
            'customExpression' => $this->frequency === 'custom' ? 'required|cron_expression' : 'nullable',
        ]);

        $this->generatedCode = <<<PHP
        // Add this to your App\Console\Kernel.php
        protected function schedule(Schedule \$schedule)
        {
            \$schedule->command('{$this->command}')
                ->name('{$this->taskName}')
                ->cron('{$cronExpression}')
                ->timezone('{$this->timezone}')
                ->withoutOverlapping()
                ->appendOutputTo(storage_path('logs/scheduler.log'));
        }
        PHP;
    }

    protected function buildExpression()
    {
        if ($this->frequency === 'custom') {
            return $this->customExpression;
        }

        [$hour, $minute] = explode(':', $this->time);
        
        return str_replace(
            ['0', '0'], 
            [$minute, $hour], 
            $this->frequencyMap[$this->frequency]
        );
    }

    public function render()
    {
        $nextRunDates = [];
        
        if (!empty($this->customExpression) && $this->frequency === 'custom') {
            try {
                $cron = CronExpression::factory($this->customExpression);
                for ($i = 0; $i < 5; $i++) {
                    $nextRunDates[] = $cron->getNextRunDate(now(), $i)->format('Y-m-d H:i:s');
                }
            } catch (\Exception $e) {
                $nextRunDates = ['Invalid expression'];
            }
        }

        return view('livewire.scheduler-builder', [
            'nextRunDates' => $nextRunDates,
            'timezones' => \DateTimeZone::listIdentifiers(),
        ]);
    }
}