<?php

namespace Sakshsky\SmartScheduler\Services;

use Cron\CronExpression;

class CronExpressionService
{
    public static function availableFrequencies()
    {
        return [
            'hourly' => 'Hourly',
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'monthly' => 'Monthly',
            'yearly' => 'Yearly',
            'custom' => 'Custom'
        ];
    }

    public static function mapFrequency($frequency, $time = '00:00')
    {
        [$hour, $minute] = explode(':', $time);

        return match ($frequency) {
            'hourly' => "$minute * * * *",
            'daily' => "$minute $hour * * *",
            'weekly' => "$minute $hour * * 0",
            'monthly' => "$minute $hour 1 * *",
            'yearly' => "$minute $hour 1 1 *",
            default => "* * * * *",
        };
    }

    public function generateScheduleCode($command, $expression, $name, $timezone, $description = '')
    {
        $code = <<<PHP
        // $description
        \$schedule->command('$command')
            ->name('$name')
            ->cron('$expression')
            ->timezone('$timezone')
            ->withoutOverlapping()
            ->appendOutputTo(storage_path('logs/scheduler.log'));
        PHP;

        return trim($code);
    }
}