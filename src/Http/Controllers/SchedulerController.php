<?php

namespace Sakshsky\SmartScheduler\Http\Controllers;

use Illuminate\Http\Request;
use Sakshsky\SmartScheduler\Models\ScheduledTask;

class SchedulerController extends Controller
{
    public function index()
    {
        return view('smart-scheduler::index', [
            'tasks' => ScheduledTask::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'command' => 'required|string',
            'cron_expression' => 'required|string',
            'timezone' => 'required|timezone',
        ]);

        ScheduledTask::create($validated);

        return redirect()->route('smart-scheduler.index');
    }

    public function run(ScheduledTask $task)
    {
        \Artisan::call($task->command);
        
        $task->update([
            'last_run_at' => now(),
            'output' => \Artisan::output()
        ]);

        return back();
    }
}